/** I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement

    This javascript file is responsible for using AJAX calls to retrieve the user's bids information

 */
/** When the site loads, the js code runs
 * 
 */
window.addEventListener("load",function(){
    //refresh the list
    refreshList();
    //declare node
    let bidList=document.getElementById("bidlist");

    /** AJAX call to get list of bids the user has put
     * 
     */
    function refreshList(){
        //the url
        let url="server/bidlist.php";
        //fetch
        fetch(url,{credentials:"include"})
            .then(response=>response.json())
            .then(refreshSuccess)
    }

    /**
     * 
     * @param {array of items} items 
     */
    function refreshSuccess(items){
        //remove elements generated
        
        while(bidList.lastElementChild){
            bidList.removeChild(itemList.lastElementChild);
        }
        //create new elements for current items on sale
        for(let i=0;i<items.length;i++){
            console.log(items[i]);
            createViewList(items[i]);
        }
        //if the user has no bids placed in history
        if(bidList.lastElementChild==null){
            $("#bidlist").append($('<li class=bids></li>').text("You didn't place any bids"));
        }
        //if the user has bids, get AJAX call to see if there are any won bids
        else{
            refreshCompleteBids();
        }
    }

    /** Creates a list of text for history of bids by user after AJAX call
     * 
     * @param {item} item 
     */
    function createViewList(item){
        $("#bidlist").append($('<li class=bids></li>').text("You have placed a bid of :$"+item.bidprice+" on item name: "+item.itemname));
    }


    /** AJAX call to get list of won items by user
     * 
     */
    function refreshCompleteBids(){
        let url="server/completebids.php"

        fetch(url,{credentials:"include"})
            .then(response=>response.json())
            .then(refreshCompleteSuccess)
    }
    /** After AJAX call is complete, create div elements for items if the user has any
     * 
     * @param {array of items} items 
     */
    function refreshCompleteSuccess(items){
        if(items!=null){
            $("main").append($('<div class=listcontainer id=itemlist>Completed Bids</div>'));
            for(let i=0; i<items.length; i++){
                createCompleteBidsView(items[i]);
            }
        }
    }
    /** creates the item div for each item
     * 
     * @param {item} item 
     */
    function createCompleteBidsView(item){
        console.log(item);
        $("#itemlist").append('<div id=item'+item.itemid+' class=item></div>');
        $("#item"+item.itemid).append($('<div class=itemname></div>').text(item.itemname));
        $("#item"+item.itemid).append($('<div class=description></div>').text("Description: "+item.description));
        $("#item"+item.itemid).append($('<div class=seller></div>').text("Seller: "+ item.seller));
        $("#item"+item.itemid).append($('<div class=starting></div>').text("Starting price: "+item.startingprice));
        $("#item"+item.itemid).append($('<div class=highest></div>').text("Highest bid: "+item.highestbid+" By: "+item.highestbidder));
    }
});