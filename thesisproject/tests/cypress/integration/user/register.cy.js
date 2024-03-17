describe('Registration testing', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();
    });

    it('Registers a new user successfully', () => {
        cy.visit('/register')
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(1)').type('NEWCOD');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(2)').type('Test name');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(3)').type('test@testmail.com');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(4)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(5)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > button').click();
        cy.contains('Mai órák');
    });

    it('Fails to register a new user with an existing code', () => {
        cy.visit('/register')
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(1)').type('studen');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(2)').type('Test name');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(3)').type('test@testmail.com');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(4)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(5)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > button').click();
        cy.contains('Ez az érték már foglalt, használjon másikat.');
    });

    it('Fails to register a new user with an existing email', () => {
        cy.visit('/register')
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(1)').type('NEWCO2');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(2)').type('Test name');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(3)').type('superadmin@presencetracker.com');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(4)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(5)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > button').click();
        cy.contains('Ez az érték már foglalt, használjon másikat.');
    });

    it('Fails to register a new user with non-matching passwords', () => {
        cy.visit('/register')
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(1)').type('NEWCO3');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(2)').type('Test name');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(3)').type('test3@testmail.com');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(4)').type('password');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > input:nth-child(5)').type('password2');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > form > div > button').click();
        cy.contains('A mezők nem egyeznek.');
    });

})
