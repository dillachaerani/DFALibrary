<div class="tab-pane fade show active p-0 pl-2 pr-2" id="{{ request()->tab }}" role="tabpanel" aria-labelledby="{{ request()->tab }}-tab">
    <div class="row mb-3" id="row_bulk_action">
        <div class="col-xl-12">
            <div class="d-flex">
                @if ($data->count() > 0)
                    @if (MyHelper::tab_class_active_true('trash'))
                        @component('components.dt-bulk-action-all', [
                            'delete_url'  => action('UserController@destroyAll', ['tab' => 'trash']),
                            'delete_msg'  => __("$lang.messages.delete_force.all.alert"),
                            'restore_url' => action('UserController@restoreAll'),
                            'restore_msg' => __("$lang.messages.restore.all.alert"),
                            'table_name'  => $table_name,
                            ])
                                @include('pages.user._index.dt-bulk-action-all')
                        @endcomponent
                    @else
                        @component('components.dt-bulk-action-all', [
                            'delete_url' => action('UserController@destroyAll'),
                            'delete_msg' => $trash ? __("$lang.messages.delete.all.alert") : __("$lang.messages.delete_force.all.alert"),
                            'table_name' => $table_name,
                            ])
                                @include('pages.user._index.dt-bulk-action-all')
                        @endcomponent
                    @endif
                @endif
                @role('developer|superadmin')
                <div class="ml-auto">
                    <div class="row pl-4">
                        @component('components.dt-enable-trash', [
                            'key'       => encrypt($key),
                            'action'    => action('SettingController@store'),
                            'is_enable' => $trash ?? false
                        ])
                        @endcomponent
                    </div>
                </div>
                @endrole
            </div>
        </div>
    </div>
    <div class="row" id="row_show_pagination">
        <div class="col-xl-12">
            @component('components.dt-nav-top', ['data' => $data])
                @slot('bulk_action')
                    @include('pages.user._index.dt-bulk-action-selected')
                @endslot
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    @component('components.dt-thead', ['child' => "item-$table_name"])
                        @include('pages.user._index.dt-thead')
                    @endcomponent
                    <tbody>
                        @forelse ($data as $row => $item)
                            <tr class="tr-show" data-href="{{ action('UserController@show', encrypt($item->id)) }}" data-modal="false" data-target="#{{ $table_name }}_modal">
                                <td class="checkbox-column text-center td-disable">
                                    <label class="new-control new-checkbox checkbox-info m-0 ml-2" style="height: 15px;">
                                        <input type="checkbox" class="new-control-input checkbox-tr {{ "item-$table_name" }}" value="{{ encrypt($item->id) }}">
                                        <span class="new-control-indicator"></span>
                                    </label>
                                </td>
                                @include('pages.user._index.dt-tbody')
                                @if (MyHelper::tab_class_active_true('trash'))
                                    <td class="nowrap">{{ MyHelper::dt_column_datetime($item->deleted_at) }}</td>
                                    <td class="text-center nowrap td-disable">
                                        @component('components.dt-column-action-adv', [
                                            'open_url'    => action('UserController@show', encrypt($item->id)),
                                            'edit_url'    => action('UserController@edit', encrypt($item->id)),
                                            'delete_url'  => action('UserController@destroy', encrypt($item->id)),
                                            'delete_msg'  => __("$lang.messages.delete_force.alert", ['attr' => $item->name]),
                                            'restore_url' => action('UserController@restore', encrypt($item->id)),
                                            'restore_msg' => __("$lang.messages.restore.alert", ['attr' => $item->name]),
                                            'row_name'    => "$table_name-" . $loop->iteration,
                                        ])
                                            @include('pages.user._index.dt-item-action')
                                        @endcomponent
                                    </td>
                                @else
                                    <td class="nowrap">{{ MyHelper::dt_column_datetime($item->updated_at) }}</td>
                                    <td class="text-center nowrap td-disable">
                                        @component('components.dt-column-action-adv', [
                                            'open_url'   => action('UserController@show', encrypt($item->id)),
                                            'edit_url'   => action('UserController@edit', encrypt($item->id)),
                                            'delete_url' => action('UserController@destroy', encrypt($item->id)),
                                            'delete_msg' => $trash ? __("$lang.messages.delete.alert", ['attr' => $item->name]) : __("$lang.messages.delete_force.alert", ['attr' => $item->name]),
                                            'row_name'   => "$table_name-" . $loop->iteration,
                                        ])
                                            @include('pages.user._index.dt-item-action')
                                        @endcomponent
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td class="align-middle" colspan="12">
                                    @lang('No data available in table') ...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            @component('components.dt-nav-bottom', ['data' => $data])
                @slot('bulk_action')
                    @include('pages.user._index.dt-bulk-action-selected')
                @endslot
            @endcomponent
        </div>
    </div>
</div>