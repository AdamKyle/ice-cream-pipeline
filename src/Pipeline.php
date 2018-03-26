<?php

namespace IceCreamPipeline;

use IceCreamPipeline\Contracts\Pipeline as PipelineContract;

/**
 * The pipeline is responsible for processing the payload.
 *
 * We process the payload through a set of pipes. These pipes can have
 * a specific method that gets called, or it defaults to `handle` method
 * on that specific pipe.
 *
 * If you call `withMethod` all pipes must implement said method.
 */
class Pipeline implements PipelineContract {

    private $item;

    private $pipes;

    private $method;

    private $response;

    /**
     * {@inheritdoc}
     */
    public function pass($item) {
        $this->item = $item;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function through($pipes) {
        $this->pipes = is_array($pipes) ? $pipes : [$pipes];
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withMethod(string $method) {
        $this->method = $method;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function process() {
        try {
            foreach ($this->pipes as $pipe) {
                if (isset($this->method)) {
                    $this->item = call_user_func_array([$pipe, $this->method], [$this->item]);
                } else {
                    $this->item = call_user_func_array([$pipe, 'handle'], [$this->item]);
                }
            }
        } catch (\Exception $e) {
            $pipeName = get_class($pipe);
            throw new \Exception($pipeName . ' does not have either a custom method defined or handle method defined.');
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse() {
        return $this->item;
    }

    /**
     * {@inheritdoc}
     */
    public function then(\Closure $func) {
        return call_user_func_array($func, [$this->item]);
    }
}
