<?php

namespace App\Admin\Controllers;

use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
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

            $content->header('用户管理');
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

            $content->header('用户管理');

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

            $content->header('用户管理');

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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->column('user_id', 'ID')->sortable();
            $grid->column('user_name', '用户名');
            $grid->column('user_role', '角色');
            $grid->column('user_realname', '真实姓名');
            $grid->column('user_mobilephone', '手机号码');
            $grid->column('user_company', '公司');
            $grid->column('user_comment', '职位');
            $grid->model()->orderBy('user_id', 'desc');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('user_id', 'ID');
            $form->text('user_name', '用户名');
            $form->password('password1', '密码')->rules('confirmed');
            $form->password('password1_confirmation', '重复密码');
            $form->text('user_role', '角色');
            $form->text('user_realname', '真实姓名');
            $form->text('user_mobilephone', '手机号码');
            $form->text('user_company', '公司');
            $form->text('user_comment', '职位');
            $form->ignore(['password1_confirmation']);

            $form->saving(function (Form $form) {
                $form->password1 = md5($form->password1);
            });
        });
    }
}
