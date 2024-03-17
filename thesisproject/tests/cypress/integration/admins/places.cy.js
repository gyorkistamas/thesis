/// <reference types="Cypress" />

describe('Testing places', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();
    });

    it('Creates a new place', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(3)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(4) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.justify-center.min-w-full.max-w-full.md\\:flex-row.md\\:justify-between > button').click();
        cy.get('#newPlaceModal > div > div > form > div > div > input').type('Test place');
        cy.get('#newPlaceModal > div > div > div > button').click();
        cy.contains('Siker');
    });

    it('Cannot create a place with the same name', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(3)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(4) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.justify-center.min-w-full.max-w-full.md\\:flex-row.md\\:justify-between > button').click();
        cy.get('#newPlaceModal > div > div > form > div > div > input').type('Test place');
        cy.get('#newPlaceModal > div > div > div > button').click();
        cy.contains('Ez az érték már foglalt, használjon másikat.');
    });


});
