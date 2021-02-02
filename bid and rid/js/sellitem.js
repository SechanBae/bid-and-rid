/** I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement

    This javascript file is responsible for using AJAX call to put an item up for sale by user

 */
/** When the site loads, the js code runs
 * 
 */
window.addEventListener("load",function(){
    //declare nodes
    let form=document.forms.sellitem;
    let messageNode=document.getElementById("message");

    /** AJAX call to INSERT item into list of items for sale
     * 
     */
    form.addEventListener("submit",function(event){
        //prevent submission
        event.preventDefault();

        //declare variables and url
        let itemname=form.itemname.value;
        let description=form.description.value;
        let price=form.price.value;
        let url="server/sell.php?itemname="+itemname+"&description="+description+"&price="+price;
        //fetch
        fetch(url,{credentials:'include'})
            .then(response=>response.text())
            .then(success)

    });
    /** After AJAX call is complete, update message and empty form
     * 
     * @param {*} message 
     */
    function success(message){
        messageNode.innerHTML=message;
        form.itemname.value="";
        form.description.value="";
        form.price.value="";
    }
});