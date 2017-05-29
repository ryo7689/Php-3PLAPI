# Php-3PLAPI
This is simple solution for calling 3PL inventory system API, this is used to Create orders, Create items, Find orders etc..

The xml files contain the basic information that is required by the APIs, they are the minimum requirements for making successful API calls.

In Request folder: findOrders.xml, createItems.xml, createOrders.xml

@param <BeginDate>
@param <EndDate>
findOrders.xml -
    Find order request, search for the orders between <BeginDate> and <EndDate>

@param <SKU>
@param <Description>
createItems.xml -
    Create item request
    
@param <Reference>
@param <POnum>
@param <Name>
@param <CompanyName>
@param <Address1>
@param <City>
@param <ZIP>
@param <SKU>
@param <Qty>
createOrders.xml -
    Create order request
