> **Project Title**
>
> Zendesk API Extension --- Mobile Ticket Viewer
>
> **Description**
>
> This project can display all the tickets and their details for your
> zendesk account by connecting to the Zendesk API.
>
> **Demo**
>
> For demonstration purpose, this mobile application is hosted in a web
> server. You can access it directly through clicking the link below.
>
> [[http://demo.ladyqi.com/]{.underline}](http://demo.ladyqi.com/)
>
> The first page lists all the tickets in the account. They includes
> ticket title and its status (O: open, P: pending, N: new, H: hold, C:
> closed, S: solved). Different status is decorated with different
> color. By clicking ticket in the list, the ticket details will be
> presented in the second page. In this page, it shows requester name,
> ticket title and description in sequence.
>
> ![](media/image1.jpg)![](media/image2.jpg)The screenshots on mobile
> look like below. The third one is for the situation when api
> authentication failed.
>
> ![](media/image3.jpg)
>
> **Installation**
>
> In order to run this web application, you need set up a web server
> such as Apache or Nginx web server. Here we take Apache Web Server as
> the example to show the whole installation.
>
> • Go to terminal and run the following command on terminal. If you are
> in windows
>
> OS, you can download XAMPP for apache web server.
>
> sudo apt-get install apache2
>
> • Go to server 's web root and create a directory (e.g. Zendesk) and
> then download project files into the directory.
>
> • Open apiconfig.ini file, modify API parameters based on your own
> zendesk account and save.
>
> **Usage Instruction**
>
> • Start web server. To start apache, run the following command on your
> terminal:
>
> sudo apachectl start
>
> • Once the service is started, go to your browser and type:
> <http://localhost/zendesk/> Now you should see the list of all the
> tickets retrieved from Zendesk account. If the data are not retrieved,
> please check whether the data in apiconfig.ini are correct based on
> error messages.
>
> **Running Tests**
>
> Before doing the test, please make sure that you have enabled basic
> authentication in the setting of zendesk api. It is disabled by
> default.
>
> • Test the presentation of tickets
>
> Create multiple end-user accounts in zendesk and then submit multiple
> tickets from these accounts, then login with agent account and
> response to these tickets and set the tickets to be different status.
>
> 1\) In list page, check whether all the tickets are shown and whether
> their status are correct.
>
> 2\) In details page, check whether ticket description and the name of
> requester are correct.
>
> In the demo above, 2 end-user accounts and 2 agents are created, they
> have created 12 tickets with 3 status.
>
> • Test error handling
>
> Different error should be shown in different situations. For a quick
> testing,
>
> 1\) Input wrong api url in apiconfig.ini, check the error below in list
> page:
>
> Error: Request API url is not valid
>
> 2\) Input wrong username/password in apiconfig.ini, check the error below
> in list page:
>
> Error: Couldn't authenticate you
>
> 3\) Input an non-integer ticket id in the link of ticket details and
> check below:
>
> Error: id must be integer
>
> 4\) Input an non-existing ticket id in the link of ticket details and
> check below:
>
> Error: No Record found, could be caused by wrong api url or id
>
> **API Reference**
>
> This application has used three types of zendesk api urls listed
> below:

  https://**{**subdomain**}**.                                               zendesk.com/api/v2/tickets.json   
  -------------------------------------------------------------------------- --------------------------------- --
                                                                                                               
  https://**{**subdomain**}**.zendesk.com/api/v2/tickets/**{**id**}**.json                                     
  https://**{**subdomain**}**.zendesk.com/api/v2/users/**{**id**}**.json                                       

> Where the API reference docs can be found here:
>
> **[https://developer.zendesk.com/rest\_api/docs/core/introduction]{.underline}**
>
> **Built With**
>
> • PHP for API request and dynamic page generation
>
> • Bootstrap for CSS in mobile version
>
> • Apache Web Server for hosting the application
>
> **Version**
>
> This is initial version with v1.0.
>
> **Author**
>
> **Qi Zhang** (Vicky) Email: <zhang.q@husky.neu.edu>
>
> **License**
>
> This project is licensed under the Apache License
