<?php

namespace App\Traits;

use App\Helpers\MyHelper;

trait BaseQueryTrait
{
    private function baseGetOrderBy($model, $conditions)
    {
        if (isset($conditions['order_by'])) {
            $order_by = $conditions['order_by'];
            $sort_by  = isset($conditions['sort_by']) ? $conditions['sort_by'] : 'asc';
            $model    = $model->orderBy($order_by, $sort_by);
        } else {
            $model = $model->orderBy('id', 'desc');
        }
        // SEARCHING
        if (isset($conditions['q']))
            $model = $this->query_scope_search($model, $conditions['q']);
        return $model;
    }
    private function baseGetOrderByRequest($model, $request)
    {
        if ($request->has('order_by')) {
            $sort = ($request->has('sort_by')) ? $request->sort_by : 'asc';
            $model = $model->orderBy($request->order_by, $sort);
        } else {
            $model = $model->orderBy('id', 'desc');
        }
        // SEARCHING
        if ($request->has('q'))
            $model = $this->query_scope_search($model, $request->q);
        return $model;
    }
    private function baseGetLimit($model, $conditions)
    {
        // START
        if (isset($conditions['start'])) {
            if ($conditions['start'])
                $model = $model->offset($conditions['start']);
        }
        // LIMIT
        if (isset($conditions['limit'])) {
            if ($conditions['limit'])
                $model = $model->limit($conditions['limit']);
        }
        return $model;
    }
    private function baseGetConditions($model, $conditions)
    {
        // SELECT IN CONDITION
        if (isset($conditions['select'])) {
            $model = $model->select($conditions['select']);
        }
        // RELATION IN CONDITION
        if (isset($conditions['with'])) {
            $model = $model->with($conditions['with']); // RELATIONSHIP
        }
        if (isset($conditions['with_counting'])) {
            $model = $model->withCount($conditions['with_counting']); // RELATIONSHIP COUNTING
        }
        // TRASH IN CONDITION
        if (isset($conditions['is_trash'])) {
            $model = $model->onlyTrashed();
        }
        return $model;
    }
    private function query_scope_search($query, $keyword)
    {
        return MyHelper::query_scope_search($query, $keyword, $this->available_fields);
    }
    public function create($data)
    {
        $create = $this->model->create($data);
        return $create;
    }
    public function update($id, $data)
    {
        $item = $this->find('id', $id);
        $update = $item->update($data);
        return $update;
    }
    public function destroy($id)
    {
        $item = $this->find('id', $id);
        $delete = $item->delete();
        return $delete;
    }
    public function destroyForce($id)
    {
        $item = $this->find('id', $id);
        $delete = $item->forceDelete();
        return $delete;
    }
    public function restore($id)
    {
        $item = $this->find('id', $id);
        $restore = $item->restore();
        return $restore;
    }
    public function firstOrNew($param)
    {
        return $this->model->firstOrNew($param);
    }
    public function updateOrCreate($param, $data)
    {
        $item = $this->model->updateOrCreate($param, $data);
        return $item;
    }
    public function deleteAllRecords()
    {
        return $this->model->whereNotNull('id')->delete();
    }
}
