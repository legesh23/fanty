<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Fant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fanty';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fant());

        $grid->column('id', __('ID'))->sortable();

        $grid->column('text', __('Task text'))->editable();
        $grid->column('level', __('Level'))
            ->editable('select', [
                'light' => 'Light',
                'medium' => 'Medium',
                'hard' => 'Hard',
                'extreme' => 'Extreme'
            ]);

        $grid->column('sex', __('Sex'))
            ->editable('select', [
                'male' => 'Male',
                'female' => 'Female',
                'both' => 'Both'
            ]);

        $grid->categories()->pluck('title')->implode(', ');

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Fant::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('text', __('Text'));
        $show->field('level', __('Level'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->hasMany(
            'categories',
            function($form) {

            }
        );

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Fant());

        $form->display('id', __('ID'));
        $form->textarea('text', __('Text'));
        $form->select('level')->options([
            'light' => 'Light',
            'medium' => 'Medium',
            'hard' => 'Hard',
            'extreme' => 'Extreme'
        ]);
        $form->multipleSelect('categories','Categories')->options(Category::all()->pluck('title','id'));
        $form->select('sex','Sex')->options([
            'male' => 'Male',
            'female' => 'Female',
            'both' => 'Both'
        ]);

        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
