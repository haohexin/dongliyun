<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;

use Encore\Admin\Grid;
use App\Models\DeviceField;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class DeviceFieldController extends Controller
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
            $content->header('核心字段');
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

            $content->header('核心字段');
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

            $content->header('核心字段');
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
        return Admin::grid(DeviceField::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '名称')->editable();
            $grid->column('field', '对应字段')->editable();
            $grid->column('unit', '单位')->editable();
            $grid->column('max', '最大值')->editable();
            $grid->column('min', '最小值')->editable();
            $grid->column('color', '颜色')->editable();
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
        return Admin::form(DeviceField::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '名称');
            $form->text('field', '对应字段');
            $form->text('unit', '单位');
            $form->number('max', '最大值');
            $form->number('min', '最小值');
            $form->color('color', '颜色');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
