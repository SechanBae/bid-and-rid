/** I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement

    This javascript file is responsible for handling events which
    which uses AJAX to work with the items being sold

 */

/** When the site loads, the js code runs
 * 
 */
window.addEventListener("load",function(){
    //refresh list of items
    refreshItems("");
    //declare nodes
    let itemList=document.getElementById("itemlist");
    let searchbar=document.getElementById("searchbar");

    /** AJAX call to get list of items with a search term parameter
     * 
     * @param {string for search} search
     */
    function refreshItems(search){
        //the url
        let url="server/itemlist.php?search="+search;
        //fetch
        fetch(url,{credentials:"include"})
            .then(response=>response.json())
            .then(refreshSuccess)
    }

    /** Once AJAX call is finished, start creating elements to form the view
     * 
     * @param {list of items} items 
     */
    function refreshSuccess(items){
        
        //remove elements generated
        while(itemList.lastElementChild){
            itemList.removeChild(itemList.lastElementChild);
        }
        //create new elements from array of items
        for(let i=0;i<items.length;i++){
            createView(items[i]);
        }
        //if there are no items, say there are no items
        if(itemList.lastElementChild==null){
            $("#itemlist").append($('<h1 class=message></h1').text("There are no items on sale right now"));
        }
    }

    /** Create a div element for each item, that contains its fields and event handlers
     * 
     * @param {item} item 
     */
    function createView(item){

        //if highest bidder is null, default it to none
        highestbidder=item.highestbidder;
        if(highestbidder==null){
            highestbidder="None";
        }
        console.log(highestbidder);
        //creating the div elements
        $("#itemlist").append('<div id=item'+item.itemid+' class=item> </div>');
        $("#item"+item.itemid).append($('<div class=itemname></div>').text(item.itemname));
        $("#item"+item.itemid).append($('<div class=description></div>').text("Description: "+item.description));
        $("#item"+item.itemid).append($('<div class=seller></div>').text("Seller: "+ item.seller));
        $("#item"+item.itemid).append($('<div class=starting></div>').text("Starting price: "+item.startingprice));
        $("#item"+item.itemid).append($('<div class=highest></div>').text("Highest bid: "+item.highestbid+" By: "+highestbidder));
        $("#item"+item.itemid).append('<input type=text class=bidfield id=bidamount'+item.itemid+'>');
        $("#item"+item.itemid).append('<button class="bidbutton" id=bid'+item.itemid+'>Place a bid</button>');
        $("#item"+item.itemid).append('<div class=warning id=warning'+item.itemid+'></div>');
        
        //event handler for button, to start AJAX call to bid on item
        $("#bid"+item.itemid).click(function(){
            if(user!=null&&user!=item.seller){
                let bidamount=document.getElementById("bidamount"+item.itemid).value;
                //url
                let url="server/placebid.php?username="+user+"&itemid="+item.itemid+"&bidamount="+bidamount;
                //fetch
                fetch(url,{credentials:'include'})
                    .then(response=>response.json())
                    .then(bidSuccess)
            }
            else if(user==item.seller){
                $("#warning"+item.itemid).text("You cannot place a bid on your own item");
            }
            else if (user==null){
                $("#warning"+item.itemid).text("You must be logged in to bid");
            }
        });
    }

    /** After AJAX call to bid is complete let user know the outcome
     * 
     * @param {array} message 
     */
    function bidSuccess(message){
        refreshItems("");

        //For some reason, the message gets overrided by the createView(), need a timer on it so that it occurs after
        let timer=setTimeout(() => {
            $("#warning"+message[1]).text(message[0]);
        }, 0050);
    }


    /** Whenever there is change to the search bar, refresh list of items with its parameters
     * 
     */
    $("#searchbar").change(function(){
        refreshItems(searchbar.value);
    });
});