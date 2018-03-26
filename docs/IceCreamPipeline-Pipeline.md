[API Index](ApiIndex.md)


IceCreamPipeline\Pipeline
---------------


**Class name**: Pipeline

**Namespace**: IceCreamPipeline



**This class implements**: [IceCreamPipeline\Contracts\Pipeline](IceCreamPipeline-Contracts-Pipeline.md)



    The pipeline is responsible for processing the payload.

    We process the payload through a set of pipes. These pipes can have
a specific method that gets called, or it defaults to `handle` method
on that specific pipe.

If you call `withMethod` all pipes must implement said method.





Properties
----------


**$item**





    private  $item






**$pipes**





    private  $pipes






**$method**





    private  $method






**$response**





    private  $response






Methods
-------


public **pass** ( mixed $item )


Pass an item into the pipeline.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $item | mixed | &lt;p&gt;item&lt;/p&gt; |

--

public **through** ( mixed $pipes )


The pipes to pass the item, through.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $pipes | mixed | &lt;p&gt;pipes&lt;/p&gt; |

--

public **withMethod** ( string $method )


Optionally call a specific method that all pipes have.








**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $method | string | &lt;p&gt;method&lt;/p&gt; |

--

public **process** (  )


Process the pipes.

itterate through each pipe either calling the method defined in
`withMethod` or a predefined method on the abstract Pipe class
called: `handle`.






--

public **getResponse** (  )


Get the response from the process.

Instead of calling `then()` you can do: `-&gt;process()-&gt;getResponse();`
to get the response of the pipeline.






--

public **then** ( Closure $func )


Optionally do something after all the pipes have finished.

The function takes one argument, that is the response from process
fucntion.






**Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| $func | IceCreamPipeline\Contracts\Closure | &lt;p&gt;func&lt;/p&gt; |

--

[API Index](ApiIndex.md)
