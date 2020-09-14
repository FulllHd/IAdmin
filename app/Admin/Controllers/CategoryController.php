<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Categories;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;

class CategoryController extends Controller {

    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header(__('i.categories'));
            $content->body(Categories::tree());
        });
    }

    public function show($id)
    {
        return redirect()->route('admin.categories.edit', ['category' => $id]);
    }

    public function create() {
        return Admin::content(function (Content $content) {
            $content->header(__('i.categories'));
            $content->body($this->form());
        });
    }

    public function edit($id) {
        return Admin::content(function (Content $content) use ($id) {
            $content->header(__('i.categories'));
            $content->body($this->form()->edit($id));
        });
    }

    protected function form() {

        $form = new Form(new Categories);

        $form->display('id', 'ID');

        $form->select('parent_id', __('i.parent_id'))->options(Categories::selectOptions());

        $form->text('titleuk', __('i.titleLNG', ['UKR']))->rules('required');
        $form->text('titleru', __('i.titleLNG', ['RU']))->rules('required');
        $form->text('titleen', __('i.titleLNG', ['ENG']))->rules('required');
        $form->text('titlepl', __('i.titleLNG', ['PL']))->rules('required');

        $form->textarea('descruk', __('i.descriptionLNG', ['UKR']));
        $form->textarea('descrru', __('i.descriptionLNG', ['RU']));
        $form->textarea('descren', __('i.descriptionLNG', ['ENG']));
        $form->textarea('descrpl', __('i.descriptionLNG', ['PL']));

        $form->radio('type', __('i.type'))->options([
            'second' => 'Second',
            'main' => 'Main'
        ])->default('second')->stacked();

        return $form;
    }
}