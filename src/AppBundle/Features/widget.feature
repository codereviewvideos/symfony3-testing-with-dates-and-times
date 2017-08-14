Feature: Manage Widget data via the RESTful API

  In order to make lots of money selling Widgets
  As a widget manufacturer
  I need to provide developer access to widget data


  Background:
    Given there are Widgets with the following details:
      | id | name     |
      | 1  | Widget A |
      | 2  | Widget B |
      | 3  | Widget C |
    And I set header "Content-Type" with value "application/json"


  Scenario: Can get a single Widget
    When I send a "GET" request to "/widget/1"
    Then the response code should be 200
    And the response should contain json:
      """
      {
          "id": 1,
          "name": "Widget A"
      }
      """
