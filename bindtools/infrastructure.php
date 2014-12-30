<?php

class BindType {
	public $name;
	public $type;
	public $checker;
	public $achecker;
	public $getter;
	public $alloc;
	public $destructor;

	public function __construct($name, $type, $checker, $achecker, $getter, $alloc, $destructor = 'free') {
		$this->name = $name;
		$this->type = $type;
		$this->checker = $checker;
		$this->achecker = $achecker;
		$this->getter = $getter;
		$this->alloc = $alloc;
		$this->destructor = $destructor;
	}

	public function alloc($name) {
		$alloc = $this->alloc;
		return $alloc($name);
	}
}

class BindArgument {
	public $type;
	public $name;
	public $check;
	public $acheck;
	public $get;

	public function __construct(BindType $type, $name) {
		$this->type = $type;
		$this->name = $name;
		$checker = $type->checker;
		$achecker = $type->achecker;
		$getter = $type->getter;
		$this->check = $checker($name);
		$this->acheck = $achecker($name);
		$this->get = $getter($name);
	}
}

class BindFunction {
	public $retval;
	public $name;
	/** @var Argument[] $args */
	public $args;

	public function __construct(BindType $retval, $name, array $args) {
		$this->retval = $retval;
		$this->name = $name;
		$this->args = $args;
	}
}

function type($name, $destructor = 'free') {
	return new BindType(
		$name,
		"{$name}*",
		function($v) use ($name) { return "kind_{$name}_check($v)"; },
		function($v) use ($name) { return ""; },
		function($v) use ($name) { return "kind_{$name}_get($v)"; },
		function($v) use ($name) { return "kind_{$name}_alloc($v)"; },
		$destructor
	);
}
function prim_type($name, $type, $checker, $achecker, $getter, $setter) { return new BindType($name, $type, $checker, $achecker, $getter, $setter, ''); };

function ptr_type($name, $valuetoprim, $primtovalue) {
	return prim_type(
		'--',
		'--',
		function($v) use ($name, $valuetoprim, $primtovalue) { return "
				val_check({$v}, array);
				int {$v}_size = val_array_size({$v});
				{$name}* {$v}_values = ({$name}*)malloc(sizeof({$name}) * {$v}_size);
				{
					for (int n = 0; n < {$v}_size; n++) {$v}_values[n] = {$valuetoprim}(val_array_i({$v}, n));
				}
			"; },
		function($v) use ($name, $valuetoprim, $primtovalue) { return "
				{
					for (int n = 0; n < {$v}_size; n++) val_array_set_i($v, n, {$primtovalue}({$v}_values[n]));
				}
				free({$v}_values);
			"; },
		function($v) use ($name, $valuetoprim, $primtovalue) { return "{$v}_values"; },
		function($v) use ($name, $valuetoprim, $primtovalue) { return "-----"; }
	);
}

function enum_type($name) {
	return prim_type(
		$name,
		$name,
		function($v) use ($name) { return "val_check($v, int)"; },
		function($v) use ($name) { return ""; },
		function($v) use ($name) { return "(($name)val_get_int($v))"; },
		function($v) use ($name) { return "alloc_int($v)"; }
	);
}
function prim_prim_type($name, $type) {
	return prim_type(
		$name,
		$type,
		function($v) use ($name) { return "val_check($v, {$name})"; },
		function($v) use ($name) { return ""; },
		function($v) use ($name) { return "val_get_{$name}($v)"; },
		function($v) use ($name) { return "alloc_{$name}($v)"; }
	);
}
function func(BindType  $retval, $name, $args) { return new BindFunction($retval, $name, $args); }
function arg(BindType $type, $name) { return new BindArgument($type, $name); }
