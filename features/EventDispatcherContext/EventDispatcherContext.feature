Feature: Event Dispatcher
    As a developer
    I want to learn Event Dispatcher System

    Scenario: Executing a Event Dispatcher System
        Given I have a Command
            And I have a Handler
            And I have an Event Dispatcher
            And I have Event Listeners
            And the Event Listeners are subscribed to the Event
            And the Handler is aware of the Event Dispatcher
        When I pass the Command to the Handler
        Then I should receive an Event
            And the Event Listeners will be notified

