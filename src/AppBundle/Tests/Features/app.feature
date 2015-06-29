Feature: I am testing my FE application

  Scenario: Default route returns "hello world"
    Given I am authenticated
    And I use the "Articles" schema
    When I request "/v1/article"
    Then the response status code should be 200
    And the response should be json
    And print last response
    And the response json key "data" should be valid