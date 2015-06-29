Feature: I am testing my FE application

  Scenario: Articles API endpoint should return valid Articles response
    Given I am authenticated
    And I use the "Articles" schema
    When I request "/v1/article"
    Then the response status code should be 200
    And the response should be json
    And the response json key "data" should be valid
    And print last response

  Scenario: Missing article ID should return Error response
    Given I am authenticated
    And I use the "Error" schema
    When I request "/v1/article/1000"
    Then the response status code should be 404
    And the response should be json
    And the response json key "status" should be valid
    And print last response