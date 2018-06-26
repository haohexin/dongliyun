<?php

namespace App\Admin\Controllers;

use App\Models\DeviceCategory;

use App\Models\DeviceCategoryCurve;
use App\Models\DeviceField;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class DeviceCategoryController extends Controller
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
            $content->header('设备类型');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('设备类型');
            $content->description('编辑');

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

            $content->header('设备类型');
            $content->description('创建');

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
        return Admin::grid(DeviceCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '类型')->editable();
            $grid->column('number', '类型标志')->editable();
            $grid->column('length', '位长度')->editable();
            $grid->curves('曲线包含项')->display(function ($curves) {

                $curves = array_map(function ($curve) {
                    $field = DeviceField::find($curve['field_id']);
                    return "<span class='label label-success'>{$field->title}</span>";
                }, $curves);

                return join('&nbsp;', $curves);
            });
//            $grid->arguments('参数包含项')->display(function ($arguments) {
//
//                $arguments = array_map(function ($argument) {
//                    $field = DeviceField::find($argument['field_id']);
//                    return "<span class='label label-success'>{$field->title}</span>";
//                }, $arguments);
//
//                return join('&nbsp;', $arguments);
//            });
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(DeviceCategory::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '类型');
            $form->text('number', '类型标志');
            $form->number('length', '位长度');
            $fields = DeviceField::get()->pluck('title', 'id');
            $form->hasMany('curves', '曲线包含项', function ($form) use ($fields) {
                $form->select('field_id', '字段')->options($fields);
                $form->number('bit', '开始位');
                $form->number('length', '长度');
            });
//            $form->hasMany('arguments', '参数包含项', function ($form) use ($fields) {
//                $form->select('field_id', '字段')->options($fields);
//            });
        });
    }
}
