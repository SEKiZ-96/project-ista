<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TimeScheduleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\StoreTimeScheduleRequest;


/**
 * Class TimeScheduleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TimeScheduleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    // use \App\Models\Teacher;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\TimeSchedule::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/time-schedule');
        CRUD::setEntityNameStrings('time schedule', 'time schedules');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // Remove the default setting which pulls in all database columns
        
        
        CRUD::addColumn([
            'name' => 'id', // Column name in 'groups' table
            'label' => '#',
            'attribute' => 'id', // Attribute to display from Group model
            'entity' => 'idd', // Relation method in TimeSchedule model
            'model' => "App\Models\TimeSchedule"
        ]);   
        CRUD::addColumn([
            'name' => 'teacher', // Column name in 'teachers' table
            'label' => 'Teacher',
            'type' => 'select',
            'entity' => 'teacherr', // Relation method in TimeSchedule model
            'attribute' => 'teacher_name', // Attribute to display from Teacher model
            'model' => "App\Models\Teacher"
        ]);

        CRUD::addColumn([
            'name' => 'room', // Column name in 'rooms' table
            'label' => 'Room',
            'type' => 'select',
            'entity' => 'roomm', // Relation method in TimeSchedule model
            'attribute' => 'room_name', // Attribute to display from Room model
            'model' => "App\Models\Room"
        ]);

        CRUD::addColumn([
            'name' => 'group', // Column name in 'groups' table
            'label' => 'Group',
            'type' => 'select',
            'entity' => 'groupp', // Relation method in TimeSchedule model
            'attribute' => 'group_name', // Attribute to display from Group model
            'model' => "App\Models\Group"
        ]);
        CRUD::addColumn([
            'name' => 'day',
            'label' => 'Day',
            'type' => 'text'
        ]);
    
        CRUD::addColumn([
            'name' => 'period',
            'label' => 'Period',
            'type' => 'closure',
            'function' => function($entry) {
                $periods = [
                    'M' => '08:30 - 13:30',
                    'M1' => '08:30 - 11:00',
                    'M2' => '11:00 - 13:30',
                    'A' => '13:30 - 18:30',
                    'A1' => '13:30 - 16:00',
                    'A2' => '16:00 - 18:30'
                ];
                return $periods[$entry->period] ?? 'Undefined'; // Handle undefined or null cases
            }
        ]);
        

        
    }


    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    // CREATE
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StoreTimeScheduleRequest::class);
        CRUD::addField([
            'name' => 'teacher', // Column name in 'teachers' table
            'label' => 'Teacher',
            'type' => 'select',
            'entity' => 'teacherr', // Relation method in TimeSchedule model
            'attribute' => 'teacher_name', // Attribute to display from Teacher model
            'model' => "App\Models\Teacher"
        ]);

        CRUD::addField([
            'name' => 'room', // Column name in 'rooms' table
            'label' => 'Room',
            'type' => 'select',
            'entity' => 'roomm', // Relation method in TimeSchedule model
            'attribute' => 'room_name', // Attribute to display from Room model
            'model' => "App\Models\Room"
        ]);

        CRUD::addField([
            'name' => 'group', // Column name in 'groups' table
            'label' => 'Group',
            'type' => 'select',
            'entity' => 'groupp', // Relation method in TimeSchedule model
            'attribute' => 'group_name', // Attribute to display from Group model
            'model' => "App\Models\Group"
        ]);
        CRUD::addField([
            'name' => 'day',  // This should be the name of the database column
            'label' => 'Day',  // Label for the dropdown
            'type' => 'select_from_array',
            'options' => [
                'Monday' => 'Monday',
                'Tuesday' => 'Tuesday',
                'Wednesday' => 'Wednesday',
                'Thursday' => 'Thursday',
                'Friday' => 'Friday',
                'Saturday' => 'Saturday'
            ],
            'allows_null' => false,  // Optional, set to true if a null value is acceptable
        ]);
        CRUD::addField([
            'name' => 'period',  // This should be the name of the database column
            'label' => 'Period',  // Label for the dropdown
            'type' => 'select_from_array',
            'options' => [
                'M' => '08:30 - 13:30',
                'M1' => '08:30 - 11:00',
                'M2' => '11:00 - 13:30',
                'A' => '13:30 - 18:30',
                'A1' => '13:30 - 16:00',
                'A2' => '16:00 - 18:30'
            ],
            'allows_null' => false,  // Optional, set to true if a null value is acceptable
        ]);
        
        
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */

    // UPDATE
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    
}
