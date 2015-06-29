Feature: Front-end application testing

  Scenario: Home page displays
    Given I am authenticated
    When I am on the homepage
    Then the response status code should be 200
    And I should see "Hello world"

  Scenario: Home page displays name parameter
    Given I am authenticated
    When I go to "/Eddie"
    Then the response status code should be 200
    And I should see "Hello Eddie"

  Scenario: Articles page displays
    Given I am authenticated
    When I go to "/article"
    Then the response status code should be 200
    And I should see "Article list" in the "h1" element
    And I should see an ".records_list" element

  Scenario: I can create a new article
    Given I am authenticated
    When I go to "/article"
    And the response status code should be 200
    And I should see "Create a new entry" in the "a" element
    And I follow "Create a new entry"
    Then the response status code should be 200
    And I should see an "form[name='appbundle_article']" element
    And I fill in "Title" with "Test Title"
    And I fill in "Content" with "Test Content"
    And I press "Create"
    Then the url should match "/article/1"
    And I should see "Test Title"
    And I should see "Test Content"