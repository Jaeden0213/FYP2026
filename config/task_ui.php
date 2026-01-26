<?php

return [
    'status' => [//groupBy
        'pending' => [//group
            'label' => 'Pending',
            'icon'  => '⏳',
            'class' => 'text-gray-500',
        ],
        'in_progress' => [
            'label' => 'In Progress',
            'icon'  => '✏️',
            'class' => 'text-blue-500',
        ],
        'completed' => [
            'label' => 'Completed',
            'icon'  => '✅',
            'class' => 'text-green-600',
        ],
         'incompleted' => [
            'label' => 'In Complete',
            'icon'  => '⚠️',
            'class' => 'text-red-600',
        ],
    ],

    'priority' => [
        'high' => [
            'label' => 'High Priority',
            'icon'  => '🔴',
            'class' => 'text-red-600',
        ],
        'medium' => [
            'label' => 'Medium Priority',
            'icon'  => '🟡',
            'class' => 'text-yellow-500',
        ],
        'low' => [
            'label' => 'Low Priority',
            'icon'  => '🟢',
            'class' => 'text-green-500',
        ],
    ],

    'category' => [
        'study' => [
            'label' => 'Study',
            'icon'  => '📚',
        ],
        'exercise' => [
            'label' => 'Exercise',
            'icon'  => '🏋️',
        ],
        'chores' => [
            'label' => 'Chores',
            'icon'  => '🧹',
        ],
        'assignment' => [
            'label' => 'Assignment',
            'icon'  => '📝',
        ],
    ],
];
