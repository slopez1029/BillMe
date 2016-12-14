/**
 * TestFucntions.js
 * Use: Storing copies of html function for TestSuite
 * (Reasoning, PHP cannot be tested well without external testing program (ex:PHPUnit)
 *  and test to SQL through this program would create actual entries, which couldn't be further tested without using terminal commands)
 * Slight modifications to work around external html form use
 */

/**
 * Login.html
 * modifications: local parameter, alerts removed
 * @pre form is filled out
 * @post returns bool for input validity
 * @param password, user
 */
function required(user, password)
{
    //var password = document.forms["form1"]["password"].value;
    //var user = document.forms["form1"]["user"].value;

    if (user == "")
    {
        //alert("Please enter a user");
        return false;
    }
    else if (password == "")
    {
        //alert("Please enter a password");
        return false;
    }

    return true;

}

/**
 *  Home.html
 *  modifications: renamed, local parameter, alert removed
 * @pre form is filled out
 * @post returns bool for input validity
 * @param totalPaid
 */
function HomeRequired(totalPaid)
{
    //var totalPaid = document.forms["form1"]["totalPaid"].value;

    if (totalPaid == "")
    {
        //alert("Please enter an amount.");
        return false;
    }

    return true;

}

/**
 *  Bills.html
 *  modifications: renamed, local parameter, alerts removed
 * @pre form is filled out
 * @post returns bool for input validity
 * @param name, totalDue, dueDate (as retrieved from form input)
 */
function BillsRequired(name, totalDue, dueDate)
{
    //var name = document.forms["form1"]["name"].value;
    //var totalDue = document.forms["form1"]["totalDue"].value;
    //var dueDate = document.forms["form1"]["dueDate"].value;

    if (name == "")
    {
        //alert("Please enter a name for the bill");
        return false;
    }
    else if (totalDue == "")
    {
        //alert("Please enter the total amount due");
        return false;
    }
    else if (dueDate == "")
    {
        //alert("Please enter the due date");
        return false;
    }

    return true;

}


/**
 * Payers.html
 * modifications: renamed, local input, alert removed
 * Checks to make sure the form for adding payers is correctly filled out before it is stored
 * @pre input sent to be checked
 * @post returns bool for input validity
 * @param userName for payer to be added
 */
function PayersRequired(payerID)
{
    //var payerID = document.forms["form1"]["payerID"].value;

    if (payerID == "")
    {
        //alert("Please enter the username of who you wish to add to the group");
        return false;
    }

    return true;

}


/**
 * CreatePayer.html
 * modifications: renames, local parameters, alerts removed, outside function yesnoCheck made local bool
 * (Note: yesnoCheck function entirely dependant on html of page, thus will not be tested)
 * Checks to make sure the form for new payers is correctly filled out before it is stored
 * @pre input sent to be checked
 * @post returns bool for input validity
 * @param password, user, groupName, groupAdmin (as retrieved from form)
 */
function CreatePayerRequired(user, password, groupName, groupAdmin, yesnoCheck)
{
    //var password = document.forms["form1"]["password"].value;
    //var user = document.forms["form1"]["user"].value;
    //var groupName = document.forms["form1"]["groupName"].value;
    //var groupAdmin = document.forms["form1"]["groupAdmin"].value;

    if (user == "")
    {
        //alert("Please enter a user");
        return false;
    }
    else if (password == "")
    {
        //alert("Please enter a password");
        return false;
    }
    else if (groupName == "")
    {
        //alert("Please enter a name for the group");
        return false;
    }
    else if (yesnoCheck)
    {
        if (groupAdmin == "") {
            //alert("Please enter the group administrator's username");
            return false;
        }
    }

    return true;

}

