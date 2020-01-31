<?php 

    App::uses('PaginatorComponent', 'Controller/Component');

    class JoinedPaginatorComponent extends PaginatorComponent {

    public $Controller;

    function startup(Controller $controller) {
        $this->Controller = $controller;
    }

    public function validateSort(Model $object, array $options, array $whitelist = array()) {
        if (isset($options['sort'])) {
            $direction = null;
            if (isset($options['direction'])) {
                $direction = strtolower($options['direction']);
            }
            if (!in_array($direction, array('asc', 'desc'))) {
                $direction = 'asc';
            }
            $options['order'] = array($options['sort'] => $direction);
        }

        if (!empty($whitelist) && isset($options['order']) && is_array($options['order'])) {
            $field = key($options['order']);
            if (!in_array($field, $whitelist)) {
                $options['order'] = null;
                return $options;
            }
        }

        if (!empty($options['order']) && is_array($options['order'])) {
            $order = array();
            foreach ($options['order'] as $key => $value) {
                $field = $key;
                $alias = $object->alias;
                if (strpos($key, '.') !== false) {
                    list($alias, $field) = explode('.', $key);
                }
                // Changed the order field list, to include items in join tables
                if (isset($object->{$alias}) && $object->{$alias}->hasField($field, true)) {
                    $order[$alias . '.' . $field] = $value;
                } else if(in_array($alias.'.'.$field, $whitelist)){
                    // Adding a white list order, to include items in the white list
                    $order[$alias . '.' . $field] = $value;
                } else if ($object->hasField($field)) {
                    $order[$object->alias . '.' . $field] = $value;
                } elseif ($object->hasField($key, true)) {
                    $order[$field] = $value;
                }
            }
            $options['order'] = $order;
        }

        return $options;
    }

    public function paginate($object = null, $scope = array(), $whitelist = array()) {
        $this->settings = am ($this->Controller->paginate, $this->settings);
        return parent::paginate($object, $scope, $whitelist );
    }
}


?>