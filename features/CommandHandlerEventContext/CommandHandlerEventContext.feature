Feature: Command - Handler - Event
    As a developer
    I want to learn Command - Handler - Event System

    Scenario: Executing a Command - Handler - Event System
        Given I have a Command
            And I have a Handler
        When I pass the Command to the Handler
        Then I should receive an Event
