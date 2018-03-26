[API Index](ApiIndex.md)


IceCreamPipeline\Contracts\Pipeline
---------------



    Basic pipeline infrastructure.

    We pass an item, what ever that may be, through a set of pipes
optionally calling on a specific method that all pipes must have
and then, optionally, we can do something once all is done and returned.


**Interface name**: Pipeline

**Namespace**: IceCreamPipeline\Contracts

**This is an interface**







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
