# T-Mobile Bootcamp Assessment
> Simple project for Bootcamp Preassessment
> Demo site - http://jazcosolutions.com/TMO-Bootcamp/

## Features
* Single PHP page that performs both local and server based math
* 2 values can be entered, math operation chosen, then executed locally or from ajax call
* Allows for Add, Multiply, Subtract, and Divide

## Local Operation

When the Calc Local button is selected, JS evaluates the chosen operation, then performs the calculation.

## Service Operation

When the Calc Service button is selected, a url is created for an ajax call.

The url follows the following format:    http://{BASEURI}/{OPERATION/VAL1/VAL2

Demo Calls
* http://jazcosolutions.com/TMO-Bootcamp/add/1/2
* http://jazcosolutions.com/TMO-Bootcamp/sub/5/2
* http://jazcosolutions.com/TMO-Bootcamp/mul/9/5
* http://jazcosolutions.com/TMO-Bootcamp/div/10/5

Results are returned as a JSON object.

> {"operation":"add","a":5,"b":10,"rslt":15,"status":"Success"}



