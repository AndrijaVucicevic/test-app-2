<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

interface FruitInterface {
    public function getVolume(): float;
    public function getColor(): string;
}

class Fruit implements FruitInterface {
    protected string $color;
    protected float $volume;

    public function __construct(string $color, float $volume) {
        $this->color = $color;
        $this->volume = $volume;
    }

    public function getVolume(): float {
        return $this->volume;
    }

    public function getColor(): string {
        return $this->color;
    }
}

class Apple extends Fruit {
    private bool $isRotten;

    public function __construct(string $color, float $volume) {
        parent::__construct($color, $volume);
        $this->isRotten = rand(1, 100) <= 20; // 20% chance of being rotten
    }

    public function isRotten(): bool {
        return $this->isRotten;
    }
}

class RottenFruitException extends Exception {
    public function __construct($message = "Cannot juice a rotten fruit!") {
        parent::__construct($message);
    }
}

class FruitContainer {
    private float $capacity;
    private array $fruits = [];

    public function __construct(float $capacity) {
        $this->capacity = $capacity;
    }

    public function addFruit(Fruit $fruit): void {
        $totalVolume = array_reduce($this->fruits, fn($carry, $fruit) => $carry + $fruit->getVolume(), 0);

        if ($totalVolume + $fruit->getVolume() > $this->capacity) {
            throw new Exception("Not enough space in the container!");
        }

        $this->fruits[] = $fruit;
    }

    public function getFruits(): array {
        return $this->fruits;
    }

    public function getRemainingCapacity(): float {
        $totalVolume = array_reduce($this->fruits, fn($carry, $fruit) => $carry + $fruit->getVolume(), 0);
        return $this->capacity - $totalVolume;
    }
}

class Strainer {
    public function juice(Fruit $fruit): float {
        if ($fruit instanceof Apple && $fruit->isRotten()) {
            throw new RottenFruitException();
        }
        return $fruit->getVolume() * 0.5;
    }
}

class Juicer {
    private FruitContainer $container;
    private Strainer $strainer;
    private float $totalJuice = 0;

    public function __construct(FruitContainer $container, Strainer $strainer) {
        $this->container = $container;
        $this->strainer = $strainer;
    }

    public function addFruit(Fruit $fruit): void {
        $this->container->addFruit($fruit);
    }

    public function squeeze(): void {
        foreach ($this->container->getFruits() as $index => $fruit) {
            try {
                $this->totalJuice += $this->strainer->juice($fruit);
                echo "Juiced a fruit with volume: {$fruit->getVolume()}, Total juice: {$this->totalJuice} liters.\n";
            } catch (RottenFruitException $e) {
                echo "Skipped a rotten fruit.\n";
            }
            unset($this->container->getFruits()[$index]); // Remove fruit after juicing
        }
    }
}

class SimulateJuicerCommand extends Command {
    
    protected $signature = 'simulate:juicer';
    protected $description = 'Simulate the operation of a juicer';

    public function handle() {
        $container = new FruitContainer(20);
        $strainer = new Strainer();
        $juicer = new Juicer($container, $strainer);

        for ($i = 1; $i <= 100; $i++) {
            if ($i % 9 === 0) {
                $volume = rand(1, 5);
                $apple = new Apple("Red", $volume);
                try {
                    $juicer->addFruit($apple);
                    $this->info("Added an apple with volume: {$volume} liters.");
                } catch (Exception $e) {
                    $this->error("Failed to add fruit: " . $e->getMessage());
                }
            }

            try {
                $juicer->squeeze();
            } catch (Exception $e) {
                $this->error("Error during squeezing: " . $e->getMessage());
            }
        }
    }
}
