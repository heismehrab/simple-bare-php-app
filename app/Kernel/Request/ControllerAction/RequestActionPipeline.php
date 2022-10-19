<?php

namespace App\Kernel\Request\ControllerAction;

/**
 * Designed to Execute the classes with given parameters
 * using Pipeline design pattern.
 *
 * specially for Kernel request's cycle.
 */
class RequestActionPipeline
{
    /**
     * Keeps the class name to execute for request.
     *
     * @var string
     */
    private string $className;

    /**
     * Keeps method name of the class to execute for request.
     *
     * @var string
     */
    private string $methodName;

    /**
     * Keeps required params for the method of the class
     * to execute for request.
     *
     * @var array
     */
    private array $methodParams = [];

    /**
     * Gets the target class.
     *
     * @param string $class
     *
     * @return self
     */
    public function class(string $class): self
    {
        $this->className = $class;

        return $this;
    }

    /**
     * Gets the target class's method.
     *
     * @param string $method
     *
     * @return self
     */
    public function method(string $method): self
    {
        $this->methodName = $method;

        return $this;
    }

    /**
     * Gets the required params for class's method.
     *
     * @param array $params
     *
     * @return self
     */
    public function params(array $params = []): self
    {
        $this->methodParams = $params;

        return $this;
    }

    /**
     * Runs the target class and return its response.
     *
     * @return mixed
     */
    public function execute(): mixed
    {
        return (new $this->className)
            ->{$this->methodName}(... $this->methodParams);
    }
}