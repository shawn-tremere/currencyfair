# currencyfair
Currency Fair  Tech  Challenge
The application is comprised of two pages.
One page to view all the messages that are posted to the application.
=>/CurrencyFair/Viewer/index.html
They are viewable through a table that allows you to filter and sort all the records.
You are also able to remove records from the table. 
The second page has three different charts, that is pulling the information from the three different views.
/CurrencyFair/Viewer/charts.html
The charts are: Currency From => Total number of transactions for each different currency coming from.
                Currency To=> Total number of transaction for each currency converting to
                Originating Country => where the request came from.
                
 THe main idea behind the application was to create REESTful API for the messages.
 you are able to post messages to the API one at a time or multiple at once. The API creates a json which is used to populate the table and the charts.
 It was important to keep the code as structured as possible and keep the different elements seperate (ie MVC). This way you are able to build on top of the application. THe application could continue to grow through adding more controllers, mappers, factories, etc. Keeping the code this way allows future development to be easier, as well as any maintanance. 
 I also tried to keep the code as clean as possible. Not go crazy with any crazy nested if statements that are hard to follow.
 I tried to keep the code as clean as possible.
 I made everything a reusalbe function where I felt appropriate, where future classes would be able to implement. 

I have put the application on https://shawntremere.000webhostapp.com/CurrencyFair/Viewer/index.html 

The website does not allow deletes without a premium account(https://www.000webhost.com/forum/t/delete-and-put-methods-not-working/61170). 
Viewing the application here will support all other functionality. 
If the application is pulled down to a local environment the delete functionality will work properly. 
Post requests can be made here: https://shawntremere.000webhostapp.com/CurrencyFair/ or /CurrencyFair/ if you pull the application down to a local environment
