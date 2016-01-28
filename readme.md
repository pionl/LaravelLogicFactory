# Laravel Factory logic

A class that support quick creation of logic classes from the LogicFactory. When you need to create a class from a string that represents the Class of the Logic Class. 

* Fully unit tested.
* Easy usage.

## Usage

You must subclass the LogicFactory and implement own static functions. Full example can be found in tests/Mock/TypeFactory.php

### createLogicList (static)
Returns a Collection of availiable logic classes. Indexed by the Class name (without namespace) and title as value.

**Example**

	/**
     * Create an own colleciton of types
     * @return \Illuminate\Support\Collection
     */
    static function createLogicList()
    {
        return new \Illuminate\Support\Collection([
            "TestType" => "Testing type"
        ]);
    }


### logicNamespace (static)
Returns current namespace of the factory subclass to load correct classes.

**Example**

	/**
     * A namespace where the logic classes are stored. Like
     * __NAMESPACE__."\\Types
     * @return string
     */
    static function logicNamespace()
    {
        return __NAMESPACE__."\\Types";
    }
    
## lists (static)
Ideal to create a select of available types. Ideal to use in database with getLogic in the model

**Example**

	{!! Form::select("test", TestFactory::lists()->toArray()) !!}
	
## valide (static)
Used to quicky check if the passed logic class string is valide (without namespace). Uses isValide function.

## title (static)
Returns the title for given logic class string (uses getTitle function)

## Example

### Basic example

	$logic = new TypeFactory("VarcharType");
	
	// returns the class you need
	$type = $logic->getLogic();
	
	$type->customMethodYouProvide();
	
### Validation

	if (!TypeFactory::valide("VarcharType")) {
		throw new Exception();
	}
	
### Title

	return TypeFactory::title("VarcharType");
	
### Eloquent Model example

	/**
     * @var OptionType|null
     */
	protected $optionType = null;
	
	protected $fillable = [
		'type'
	];
	
	/**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Returns a type helper
     * @return OptionType|null
     */
	public function getTypeHelper()
	{
		if (is_null($this->optionType)) {
			$this->optionType = new OptionType($this->getType(), $this);
		}

		return $this->optionType;
	}

## Todo

* refactor to interface
* Trait for eloquent models for quick logic helper creator
* add automatic file based Logic Class loading from the given logicNamespace (defined as a folder) with some sort of caching.
