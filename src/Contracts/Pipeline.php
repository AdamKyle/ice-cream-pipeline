<?php

namespace IceCreamPipeline\Contracts;

/**
 * Basic pipeline infrastructure.
 *
 * We pass an item, what ever that may be, through a set of pipes
 * optionally calling on a specific method that all pipes must have
 * and then, optionally, we can do something once all is done and returned.
 */
interface Pipeline
{
    /**
     * Pass an item into the pipeline.
     *
     * @param mixed item
     * @return self
     */
    public function pass($item);

    /**
     * The pipes to pass the item, through.
     *
     * @param mixed pipes
     * @return mixed
     */
    public function through($pipes);

    /**
     * Optionally call a specific method that all pipes have.
     *
     *
     * @param string method
     * @return self
     */
    public function withMethod(string $method);

    /**
     * Process the pipes.
     *
     * itterate through each pipe either calling the method defined in
     * `withMethod` or a predefined method on the abstract Pipe class
     * called: `handle`.
     *
     * @return self
     */
    public function process();

    /**
     * Get the response from the process.
     *
     * Instead of calling `then()` you can do: `->process()->getResponse();`
     * to get the response of the pipeline.
     */
    public function getResponse();

    /**
     * Optionally do something after all the pipes have finished.
     *
     * The function takes one argument, that is the response from process
     * fucntion.
     *
     * @param Closure func
     */
    public function then(\Closure $func);
}
