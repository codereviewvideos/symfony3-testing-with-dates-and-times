Feature: Manage Widget data via a JSON API

  In order to make lots of money selling Widgets
  As a widget manufacturer
  I need to provide developer access to widget data


  Background:
    Given the system time at the start of this test is "1 January 2020 00:00:00"
    And there are Widgets with the following details:
      | id | name     | created_at | updated_at |
      | 1  | Widget A | -7 days    | -5 minutes |
      | 2  | Widget B | -1 day     | -1 day     |
      | 3  | Widget C | -6 months  | -3 weeks   |
    And I set header "Content-Type" with value "application/json"


  Scenario: Can get a single Widget
    When I send a "GET" request to "/widget/1"
    Then the response code should be 200
    And the response should contain json:
      """
      {
          "id": 1,
          "name": "Widget A",
          "created_at": "2019-12-25T00:00:00+0000",
          "updated_at": "2019-12-31T23:55:00+0000"
      }
      """


  Scenario: Can add a new Widget
    When I send a "POST" request to "/widget" with body:
       """
       {
          "name": "new widget"
       }
       """
    Then the response code should be 201
     And I follow the link in the Location response header
    Then the response should contain json:
      """
      {
          "name": "new widget"
      }
      """
