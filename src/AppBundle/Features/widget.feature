Feature: Manage Widget data via a JSON API

  In order to make lots of money selling Widgets
  As a widget manufacturer
  I need to provide developer access to widget data


  Background:
    Given there are Widgets with the following details:
      | id | name     | created_at | updated_at |
      | 1  | Widget A | -4 days    | -5 minutes |
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
          features: [
            {
              "id": 1,
              "name": "some feature",
              "created_at": "2015-01-01T00:00:00+0000",
              "updated_at": "2015-01-01T00:00:00+0000",
            },
            {
              "id": 1,
              "name": "another feature",
              "created_at": "2016-01-01T00:00:00+0000",
              "updated_at": "2016-01-01T00:00:00+0000",
            }
          ]
      }
      """
    And the "created_at" date should be approximately "-4 days"
    And the "updated_at" date should be approximately "-5 minutes"
