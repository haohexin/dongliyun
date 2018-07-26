<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Device;
use App\Models\DeviceCategory;
use App\Models\Province;
use App\Models\Region;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class DeviceController extends Controller {
	use ModelForm;

	/**
	 * Index interface.
	 *
	 * @return Content
	 */
	public function index() {
		return Admin::content(function (Content $content) {

			$content->header('设备管理');
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
	public function edit($id) {
		return Admin::content(function (Content $content) use ($id) {

			$content->header('设备管理');
			$content->body($this->form()->edit($id));
		});
	}

	/**
	 * Create interface.
	 *
	 * @return Content
	 */
	public function create() {
		return Admin::content(function (Content $content) {

			$content->header('设备管理');
			$content->body($this->form());
		});
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Admin::grid(Device::class, function (Grid $grid) {

			$grid->id('ID')->sortable();
			$grid->column('base_customer', '客户名称')->editable();
			$grid->column('category.title', '设备类型')->label('warning');
			$grid->column('base_model_user', '型号识别定义编号');
			$grid->column('base_serial', '设备序列号')->sortable();
			$grid->column('region.region_name', '大区')->label();
			$grid->column('province.province_name', '省')->label();
			$grid->column('city.city_name', '市')->label();
			$grid->model()->orderBy('id', 'desc');
		});
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {
		return Admin::form(Device::class, function (Form $form) {
			$form->display('id', 'ID');
			$form->text('base_customer', '客户名称');
			$form->select('category_id', '设备类型')->options(DeviceCategory::pluck('title', 'id'));
			$form->text('base_model_head', '型号识别头编号');
			$form->text('base_model_user', '型号识别定义编号');
			$form->text('base_model_tail', '型号识别尾编号');
			$form->text('base_serial', '追加序列号');
			$form->text('base_serial_more', '序列号');
			$form->text('base_number', '编号');
			$form->text('base_supplier', '代理商');
			$form->text('base_supplier_satff', '代理商联系人');
			$form->text('base_supplier_telephone', '代理联系电话');
			$form->text('base_beko_staff', 'BEKO销售');
			$form->text('base_beko_telephone', 'BEKO销售电话');
			$form->text('base_beko_area_manager', 'BEKO区域经理');
			$form->text('base_beko_sales_director', 'BEKO销售总监');
			$form->text('base_sale_time', '出厂时间');
			$form->text('base_init_time', '开机时间');
			$form->select('base_district_region', '使用区域(大区)')->options(Region::pluck('region_name', 'region_id'));
			$form->select('base_district_province', '使用区域(市)')->options(Province::pluck('province_name', 'province_id'));
			$form->select('base_district_city', '使用区域(市)')->options(City::pluck('city_name', 'city_id'));
			$form->text('base_district_comment', '区域备注');
			$form->text('base_industry', '使用行业');
			$form->text('base_industry_comment', '行业备注');
			$form->text('base_img', '设备图片');
			$form->text('base_B1_B2_status', 'B1B2塔状态');
			$form->text('base_control_mode', '控制模式');
			$form->text('maintain_before_days', '报警提前提醒天数');
			$form->text('waring_phone1', '报警联系电话1');
			$form->text('waring_phone2', '报警联系电话2');
			$form->text('waring_phone3', '报警联系电话3');
			$form->text('maintain_phone1', '保养推送电话1');
			$form->text('maintain_phone2', '保养推送电话2');
			$form->text('maintain_phone3', '保养推送电话3');
		});
	}
}
