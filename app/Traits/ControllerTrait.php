<?php

namespace App\Traits;

use App\Helpers\APIHelper;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;

trait ControllerTrait
{
    public function sheetSync(Request $request)
    {
        if (request()->ajax()) {
            if ($settings = $this->settings) {
                if ($request->type == "import") {;
                    if ($settings->sheet_import_id) {
                        $data = [
                            'link_download' => MyHelper::google_sheet_url_export($settings->sheet_import_id)
                        ];
                        $this->syncFormat($settings->sheet_import_id, $settings->id);
                        $response = APIHelper::createAPIResponse(false, 200, __('Sync Sheet is Success!'), $data);
                    } else
                        $response = APIHelper::createAPIResponse(true, 404, __('Sheet ID Not Found!'));
                } else {
                    if ($settings->sheet_id) {
                        $data = [
                            'link_download' => MyHelper::google_sheet_url_export($settings->sheet_id)
                        ];
                        $this->syncData($settings->sheet_id, $settings->id);
                        $response = APIHelper::createAPIResponse(false, 200, __('Sync Sheet is Success!'), $data);
                    } else
                        $response = APIHelper::createAPIResponse(true, 404, __('Sheet ID Not Found!'));
                }
            }
            return $response;
        } else {
            MyHelper::flash_notification(true, __('Process is Fail!'));
            if ($settings = $this->settings) {
                if (!$settings->sheet_id && !$settings->sheet_import_id)
                    MyHelper::flash_notification(true, __('Sheet ID Not Found!'));
                else {
                    if ($settings->sheet_id)
                        $this->syncData($settings->sheet_id, $settings->id);
                    if ($settings->sheet_import_id)
                        $this->syncFormat($settings->sheet_import_id, $settings->id);
                    MyHelper::flash_notification(false, __('Google Sheet has been updated successfully'));
                }
            }
            return redirect()->back();
        }
    }

    // RESTORE TRASH
    public function restore($id)
    {
        try {
            if ($this->trash) {
                $item = $this->modelRepo->find('id', decrypt($id));
                $this->modelRepo->restore(decrypt($id));
                MyHelper::flash_notification(false, __($this->lang . '.messages.restore.success', ['attr' => $item[$this->attr]]));
                $controller = MyHelper::route_get_controller();
                return redirect()->action("$controller@index", ['tab' => 'trash']);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
            return redirect()->back();
        }
    }
    public function restoreSelected(Request $request)
    {
        try {
            if ($this->trash) {
                $dataID  = $request->id;
                $items   = [];
                $success = 0;
                foreach ($dataID as $id) {
                    $item = $this->modelRepo->find('id', decrypt($id));
                    $this->modelRepo->restore(decrypt($id));
                    $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.restore.success', ['attr' => $item[$this->attr]]));
                    $success++;
                }
                if ($success > 0) {
                    MyHelper::flash_notification(false, __($this->lang . '.messages.restore.selected.success', ['attr' => $success]), $items);
                    $response = APIHelper::createAPIResponse(false, 200, "Restore successfull", $items);
                } else {
                    MyHelper::flash_notification(true, __($this->lang . '.messages.restore.selected.failed', ['attr' => $success]), $items);
                    $response = APIHelper::createAPIResponse(true, 400, "Restore failed", $items);
                }
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
        }
        return $response;
    }
    public function restoreAll(Request $request)
    {
        try {
            if ($this->trash) {
                $items                  = [];
                $success                = 0;
                $conditions['is_trash'] = true;
                foreach ($this->modelRepo->get($conditions) as $item) {
                    $this->modelRepo->restore($item->id);
                    $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.restore.success', ['attr' => $item[$this->attr]]));
                    $success++;
                }
                if ($success > 0) {
                    MyHelper::flash_notification(false, __($this->lang . '.messages.restore.selected.success', ['attr' => $success]), $items);
                } else {
                    MyHelper::flash_notification(true, __($this->lang . '.messages.restore.selected.failed', ['attr' => $success]), $items);
                }
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }

    // activate
    public function activate($id)
    {
        try {
            $item = $this->modelRepo->find('id', decrypt($id));
            if (!$item->is_active) {
                $this->modelRepo->update($item->id, ['is_active' => true]);
                MyHelper::flash_notification(false, __($this->lang . '.messages.activate.success', ['attr' => $item[$this->attr]]));
            } else if ($item->is_active) {
                $this->modelRepo->update($item->id, ['is_active' => false]);
                MyHelper::flash_notification(false, __($this->lang . '.messages.deactivate.success', ['attr' => $item[$this->attr]]));
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }
    public function activateSelected(Request $request)
    {
        try {
            $dataID  = $request->id;
            $items   = [];
            $success = 0;
            $type    = $request->type;
            foreach ($dataID as $id) {
                $item = $this->modelRepo->find('id', decrypt($id));
                if ($type == "activate") {
                    if (!$item->is_active) {
                        $this->modelRepo->update($item->id, ['is_active' => true]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.activate.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                } else if ($type == "deactivate") {
                    if ($item->is_active) {
                        $this->modelRepo->update($item->id, ['is_active' => false]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.deactivate.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . ".messages.$type.selected.success", ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(false, 200, "Process is Success!", $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . ".messages.$type.selected.failed", ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
        }
        return $response;
    }
    public function activateAll(Request $request)
    {
        try {
            $items      = [];
            $success    = 0;
            $conditions = [];
            $type       = $request->type;
            if ($request->tab == 'trash')
                $conditions['is_trash'] = true;
            foreach ($this->modelRepo->get($conditions) as $item) {
                if ($type == "activate") {
                    if (!$item->is_active) {
                        $this->modelRepo->update($item->id, ['is_active' => true]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.activate.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                } else if ($type == "deactivate") {
                    if ($item->is_active) {
                        $this->modelRepo->update($item->id, ['is_active' => false]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.deactivate.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . ".messages.$type.selected.success", ['attr' => $success]), $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . ".messages.$type.selected.failed", ['attr' => $success]), $items);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }

    // publish
    public function publish($id)
    {
        try {
            $item = $this->modelRepo->find('id', decrypt($id));
            if (!$item->is_publish) {
                $this->modelRepo->update($item->id, ['is_publish' => true]);
                MyHelper::flash_notification(false, __($this->lang . '.messages.publish.success', ['attr' => $item[$this->attr]]));
            } else if ($item->is_publish) {
                $this->modelRepo->update($item->id, ['is_publish' => false]);
                MyHelper::flash_notification(false, __($this->lang . '.messages.unpublish.success', ['attr' => $item[$this->attr]]));
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }
    public function publishSelected(Request $request)
    {
        try {
            $dataID  = $request->id;
            $items   = [];
            $success = 0;
            $type    = $request->type;
            foreach ($dataID as $id) {
                $item = $this->modelRepo->find('id', decrypt($id));
                if ($type == "publish") {
                    if (!$item->is_publish) {
                        $this->modelRepo->update($item->id, ['is_publish' => true]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.publish.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                } else if ($type == "unpublish") {
                    if ($item->is_publish) {
                        $this->modelRepo->update($item->id, ['is_publish' => false]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.unpublish.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . ".messages.$type.selected.success", ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(false, 200, "Process is Success!", $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . ".messages.$type.selected.failed", ['attr' => $success]), $items);
                $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            $response = APIHelper::createAPIResponse(true, 400, "Process is Fail!", $items);
        }
        return $response;
    }
    public function publishAll(Request $request)
    {
        try {
            $items      = [];
            $success    = 0;
            $conditions = [];
            $type       = $request->type;
            if ($request->tab == 'trash')
                $conditions['is_trash'] = true;
            foreach ($this->modelRepo->get($conditions) as $item) {
                if ($type == "publish") {
                    if (!$item->is_publish) {
                        $this->modelRepo->update($item->id, ['is_publish' => true]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.publish.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                } else if ($type == "unpublish") {
                    if ($item->is_publish) {
                        $this->modelRepo->update($item->id, ['is_publish' => false]);
                        $items[] = MyHelper::flash_notification_item(false, __($this->lang . '.messages.unpublish.success', ['attr' => $item[$this->attr]]));
                        $success++;
                    }
                }
            }
            if ($success > 0) {
                MyHelper::flash_notification(false, __($this->lang . ".messages.$type.selected.success", ['attr' => $success]), $items);
            } else {
                MyHelper::flash_notification(true, __($this->lang . ".messages.$type.selected.failed", ['attr' => $success]), $items);
            }
        } catch (\Exception $e) {
            \Log::emergency("File : " . $e->getFile() . ", Line : " . $e->getLine() . ", Message : " . $e->getMessage());
            MyHelper::flash_notification(true, __('Process is Fail!'));
        }
        return redirect()->back();
    }

    public function removeImage(Request $request)
    {
        $item = $this->modelRepo->find('id', decrypt($request->id));
        if ($item) {
            if ($request->name == "image") {
                if ($item->image) {
                    $this->deleteImage($this->imgPath, $item->image, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['image' => null]);
                    $name = "Image " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            } else if ($request->name == "icon") {
                if ($item->icon) {
                    $this->deleteImage($this->imgPath, $item->icon, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['icon' => null]);
                    $name = "Icon " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            } else if ($request->name == "logo") {
                if ($item->logo) {
                    $this->deleteImage($this->imgPath, $item->logo, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['logo' => null]);
                    $name = "Logo " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            } else if ($request->name == "image_story") {
                if ($item->image_story) {
                    $this->deleteImage($this->imgPath, $item->image_story, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['image_story' => null]);
                    $name = "Image Story " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            } else if ($request->name == "avatar") {
                if ($item->avatar) {
                    $this->deleteImage($this->imgPath, $item->avatar, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['avatar' => null]);
                    $name = "Avatar " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            } else if ($request->name == "cover") {
                if ($item->cover) {
                    $this->deleteImage($this->imgPath, $item->cover, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['cover' => null]);
                    $name = "Cover " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            } else if ($request->name == "proof") {
                if ($item->proof) {
                    $this->deleteImage($this->imgPath, $item->proof, $this->imgSizes);
                    $this->modelRepo->update(decrypt($request->id), ['proof' => null]);
                    $name = "Proof " . $item[$this->attr];
                    $message = $name . __(' has been removed successfully!');
                    $response = APIHelper::createAPIResponse(false, 200, $message);
                    return $response;
                }
            }
        }
        $response = APIHelper::createAPIResponse(true, 404, "Remove Failed!");
        return $response;
    }
}
