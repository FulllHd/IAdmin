<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Form;

use App\Ads;
use App\Categories;

class AdsController extends AdminController {

    protected function title() {
        return __('ads');
    }

    protected function grid()
    {
        $grid = new Grid(new ADS);
        $grid->column('id', __('ID'))->sortable();
        $grid->column('accountType', __('i.accountType'))
            ->sortable()
            ->display(function ($type) {
                return $type > 1 ? __('i.employer') : __('i.employee');
            });
        $grid->column('time', __('i.time'))
            ->sortable()
            ->display(function ($time) {
                return date('d M Y H:m', $time);
            });

        $grid->column('region', __('i.region'));
        
        $grid->column('title_any', __('i.title'));
        $grid->column('description_any', __('i.description'));
        $grid->column('inactive', __('i.isActive?'))
            ->sortable()
            ->display(function ($inactive) {
                return $inactive ? __('i.no') : __('i.yes');
            });

        $grid->column('adm_check', __('i.isChecked?'))
            ->sortable()
            ->display(function ($chacked) {
                return $chacked ? __('i.yes') : __('i.no');
            });

        return $grid;
    }

    protected function form () {
        $form = new Form(new ADS);

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