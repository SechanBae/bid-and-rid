/** I, Sechan Bae, 000803348 certify that this material is my original work.
    No other person's work has been used without due acknowledgement

    This javascript file is responsible for using AJAX call to register user

 */
/** When the site loads, the js code runs
 * 
 */
window.addEventListener("load",function(){
    //declare nodes
    let form=document.forms.signup;
    let messageNode=document.getElementById("message");

    /** AJAX call to INSERT new user
     *  
     */    
    form.addEventListener("submit",function(event){
        //prevent reload
        event.preventDefault();
        

        //declare variables
        let username=form.username.value;
        let password=form.password.value;
        let passwordConfirm=form.passwordconfirm.value;
        let name=form.fname.value+" "+form.lname.value;
        let email=form.email.value;
        //password must match confirmation
        if(passwordConfirm==password){
            //url
            let url="server/signup.php?username="+username+"&password="+password+"&name="+name+"&email="+email;
            //fetch
            fetch(url,{credentials:'include'})
                .then(response=>response.text())
                .then(success)
        }
        else{
            messageNode.innerHTML="Passwords must match";
        }

    });
    
    /** After AJAX call, update message and empty form fields
     * 
     * @param {*} message 
     */
    function success(message){
        messageNode.innerHTML=message;
        form.username.value="";
        form.password.value="";
        form.passwordconfirm.value="";
        form.fname.value="";
        form.lname.value="";
        form.email.value="";
    }
});