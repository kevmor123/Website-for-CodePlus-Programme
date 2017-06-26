# CodePlus


#### Requests
| Status        | Meaning |
| ------------- | ------------- |
| -2 | Rejected by Mentor |
| -1 | Rejected by CodePlus |
| 0 |  Requested |
| 1 | Accepted by CodePlus  |
| 2 | Accepted by Mentor  |


#### Webpages
1. search page for mentors

2. profile display page

3. mentor edit page

4. login page

5. registration page with code

6. admin page with list of bookings for week and total

#### Accounts
* system account - for bridge 21

* mentor account - for mentors to set available hours + edit profile

* school - no account, special token instead

#### Booking flow
school books on website -> pending request sent to bridge21 -> bride 21 approve -> request to mentor sent -> mentor approves request -> booking approved

## Possible datatypes

#### Mentor
*	image
*	name
*	job title
*	school
*	descriptions
*	(email) hidden
*	availablitiy calendar
*	current living location

#### Request
*	school name
*	school email
*	number of students
*	small message
