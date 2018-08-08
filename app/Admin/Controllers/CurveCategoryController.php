<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;

use Encore\Admin\Grid;
use App\Models\DeviceField;
use App\Models\CurveCategory;
use App\Models\DeviceCategory;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CurveCategoryController extends Controller
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

            $content->header('曲线类型');

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

            $content->header('曲线类型');

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

            $content->header('曲线类型');

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
        return Admin::grid(CurveCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('deviceCategory.title', '设备类型')->label();
            $grid->column('title', '名称');
            $grid->fields('显示项')->display(function ($fields) {

                $fields = array_map(function ($field) {
                    $field_info = DeviceField::find($field['id']);
                    return "<span class='label label-success'>{$field_info->title}</span>";
                }, $fields);

                return join('&nbsp;', $fields);
            });
            $grid->created_at('创建于');
            $grid->updated_at('修改于');
            $grid->disableCreateButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(CurveCategory::class, function (Form $form) {
            $url_array = explode('/', \URL::full());
            $fields = CurveCategory::find($url_array[5])->deviceCategory->field->pluck('title', 'id');
            // dd($fields);
            $form->display('id', 'ID');
            $deviceCategory = DeviceCategory::pluck('title', 'id');
            $form->select('device_category_id', '设备类型')->options($deviceCategory);
            $form->text('title', '名称');
            $form->listbox('fields', '显示项')->options($fields);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
