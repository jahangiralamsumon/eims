<?php

/**
 * Form model for displaying a list of authorization items.
 */
class AddAuthItemForm extends CFormModel
{
    /**
     * @var array a list of authorization items.
     */
    public $items;

    /**
     * Returns the attribute labels.
     * @return array attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'items' => 'Role',
        );
    }

    /**
     * Returns the validation rules for attributes.
     * @return array validation rules.
     */
    public function rules()
    {
        return array(
            array('items', 'required'),
        );
    }
}
