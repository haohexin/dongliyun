<?php

namespace App\Admin\Controllers;

use App\Models\Device;
use App\Models\RuntimeData;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class RuntimeDataController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('累计功率管理');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('累计功率管理');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(RuntimeData::class, function (Grid $grid) {

            $grid->runtime_data_id('ID')->sortable();
            $grid->column('device.base_customer', '客户');
            $grid->column('device.base_model_user', '型号识别定义编号');
            $grid->column('device.base_serial', '设备序列号')->label();
            $grid->column('instantaneous_power', '瞬时功率/KW');
            $grid->column('accumulative_power', '累计功率/KW')->label();
            $grid->column('insert_time','创建时间')->display(function () {
                return Carbon::createFromTimestamp($this->insert_time)->toDateTimeString();
            });
            $devices = Device::where('category_id',5)->pluck('id');
            $grid->model()->whereIn('device_id',$devices);
            $grid->model()->orderBy('runtime_data_id', 'desc');
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->filter(function($filter){
                $filter->disableIdFilter();
                $base_serial_array = Device::where('category_id',5)->pluck('base_serial','id');
                $filter->in('device_id', '设备序列号')->multipleSelect($base_serial_array);
                $filter->between('created_at', '创建时间')->datetime();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(RuntimeData::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
