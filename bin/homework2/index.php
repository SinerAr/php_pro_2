<?php
interface ICalcPerimeter{
    public function calcPerimeter(): float;
}
interface ICalcArea{
    public function calcArea(): float;
}

class Figure implements ICalcPerimeter {

    protected string $FigureName;
    protected Array $dimensions;
    public function __construct (string $FigureName, array $dimensions)
    {
        $this->FigureName = $FigureName;
        $this->dimensions = $dimensions;
        $this->ValidateFigure($FigureName, $dimensions);
    }

    protected function ValidateFigure():void
    {
        switch ($this->FigureName) {
            case 'Square':
                $this->IsSqure();
                break;
            case 'Rectangle':
                $this->IsRectangle();
                break;
            case 'Triangle':
                $this->IsTriangle();
                break;
        }
    }
    protected function IsSqure():bool
    {
        if (count($this->dimensions) != 1)
            throw new InvalidArgumentException("Square has one dimension");
        return true;
    }
    protected function IsRectangle():bool
    {
        if (count($this->dimensions) != 2)
            throw new InvalidArgumentException("Rectangle has two dimensions");
        return true;
    }
    protected function IsTriangle():bool
    {
        $sortdimensions = $this->dimensions;
        sort($sortdimensions);
        if (count($sortdimensions) != 3)
            throw new InvalidArgumentException("Triangle has three dimensions");
        else if ($sortdimensions[0]+$sortdimensions[1]<=$sortdimensions[2])
            throw new InvalidArgumentException("Incorrect lengths of triangle sides");
        return true;
    }

    public function calcPerimeter(): float
    {
        $result = 0;
        switch ($this->FigureName) {
            case 'Square':
                $result = $this->dimensions[0] * 4;
                break;
            case 'Rectangle':
                $result = ($this->dimensions[0] + $this->dimensions[1]) * 2;
                break;
            case 'Triangle':
                $result = $this->dimensions[0] + $this->dimensions[1] + $this->dimensions[2];
                break;
        }
        return $result;
    }
}

class Triangle extends Figure implements ICalcArea {
    public function calcArea(): float
    {
        $p = $this->calcPerimeter()/2;
        return sqrt($p * ($p-$this->dimensions[0]) * ($p-$this->dimensions[1]) * ($p-$this->dimensions[2]));
    }
}


$objKvadrat = new Figure('Square', [5]);
var_dump($objKvadrat->calcPerimeter());

$objPryamougolnik = new Figure('Rectangle', [14, 21]);
var_dump($objPryamougolnik->calcPerimeter());

$objTreugolnik = new Triangle('Triangle', [31,15,41]);
var_dump($objTreugolnik->calcPerimeter());
var_dump($objTreugolnik->calcArea());

