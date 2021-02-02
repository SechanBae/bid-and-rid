/** I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement
    
    This javascript file is responsible for using AJAX call to get list of items being sold by user

 */
/** When the site loads, the js code runs
 * 
 */
window.addEventListener("load",function(){
    //refresh items
    refreshItems();
    //declare nodes
    let itemList=document.getElementById("itemlist");

    /** AJAX call to get list of items user has put for sale
     * 
     */
    function refreshItems(){
        //the url
        let url="server/myitemslist.php";
        //fetch
        fetch(url,{credentials:"include"})
            .then(response=>response.json())
            .then(refreshSuccess)
    }
    /** After AJAX call is complete, start form the elements for the view
     * 
     * @param {Array of items} items 
     */
    function refreshSuccess(items){
        //remove elements generated
        while(itemList.lastElementChild){
            itemList.removeChild(itemList.lastElementChild);
        }
        //create new elements for current items on sale
        for(let i=0;i<items.length;i++){
            createView(items[i]);
        }
        //if itemlist is empty, tell user he has no items
        if(itemList.lastElementChild==null){
            $("#itemlist").append('<h1 id=message>You do not have any items on sale</h1>');
        }
        
    }

    /** Create a div element for each item with its fields and event handlers
     * 
     * @param {item} item 
     */
    function createView(item){
        //if highest bidder is null, default is none
        highestbidder=item.highestbidder;
        if(highestbidder===null){
            highestbidder="None";
        }

        //creating the div elements
        $("#itemlist").append('<div id=item'+item.itemid+' class=item></div>');
        $("#item"+item.itemid).append($('<div class=itemname></div>').text(item.itemname));
        $("#item"+item.itemid).append($('<div class=description></div>').text("Description: "+item.description));
        $("#item"+item.itemid).append($('<div class=seller></div>').text("Seller: "+ item.seller));
        $("#item"+item.itemid).append($('<div class=starting></div>').text("Starting price: "+item.startingprice));
        $("#item"+item.itemid).append($('<div class=highest></div>').text("Highest bid: "+item.highestbid+" By: "+highestbidder));
        $("#item"+item.itemid).append('<div class=warning id=warning'+item.itemid+'></div>');

        //if the item is still up for sale, add buttons and event handlers
        if(item.complete==0){
            $("#item"+item.itemid).append('<button id=delete'+item.itemid+' class=deleteitem> Delete Item </button>');
            
            //AJAX call to delete item
            $("#delete"+item.itemid).click(function(){
                
                let url="server/deleteitem.php?itemid="+item.itemid;
                console.log(url);
                fetch(url,{credentials:"include"})
                    .then(response=>response.text())
                    .then(deleteSuccess)
            });
            //if there is a bidder, add a button and event handler to accept highest bid
            if(highestbidder!="None"){
                
                $("#item"+item.itemid).append('<button id=accept'+item.itemid+' class=acceptbid> Accept Bid </button>');
                //AJAX call to accept highest bid and put it off the sale list
                $("#accept"+item.itemid).click(function(){
                    let url="server/acceptitem.php?itemid="+item.itemid;
        
                    fetch(url,{credentials:"include"})
                        .then(response=>response.text())
                        .then(acceptSuccess)
                });
            }
        }
        //if the item has been accepted by user
        else{
            $("#warning"+item.itemid).text("This bid has been completed");
        }
        
    }
    /** After AJAX call is complete update message
     * 
     * @param {*} message 
     */
    function acceptSuccess(message){
        console.log(message);
        if(message==="Success"){
            refreshItems();
        }
    }
    /**After AJAX call is complete update message
     * 
     * @param {*} message 
     */
    function deleteSuccess(message){
        console.log(message);
        if(message==="Success"){
            refreshItems();
        }
    }
});