/// <reference types="Cypress" />

describe('Testing semester', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();
    });

    it('Creates new semester with correct data', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(2) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.min-w-full.max-w-full.md\\:flex-row.justify-center.md\\:justify-between > button').click();
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-col.items-center > div > input').type('Test semester');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(1) > input').type('2024-01-01');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(2) > input').type('2024-02-01');
        cy.get('#newSemesterModal > div > div > div > button').click();
        cy.contains('Siker');
    });

    it('Cannot create new semester that overlaps another 1', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(2) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.min-w-full.max-w-full.md\\:flex-row.justify-center.md\\:justify-between > button').click();
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-col.items-center > div > input').type('Test semester');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(1) > input').type('2024-01-30');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(2) > input').type('2024-02-10');
        cy.get('#newSemesterModal > div > div > div > button').click();
        cy.contains('A megadott dátumok átfedésben vannak egy már létező félévvel');
    });

    it('Cannot create new semester that overlaps another 2', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(2) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.min-w-full.max-w-full.md\\:flex-row.justify-center.md\\:justify-between > button').click();
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-col.items-center > div > input').type('Test semester');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(1) > input').type('2023-12-10');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(2) > input').type('2024-01-10');
        cy.get('#newSemesterModal > div > div > div > button').click();
        cy.contains('A megadott dátumok átfedésben vannak egy már létező félévvel');
    });

    it('Cannot create new semester that overlaps another 3', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(2) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.min-w-full.max-w-full.md\\:flex-row.justify-center.md\\:justify-between > button').click();
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-col.items-center > div > input').type('Test semester');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(1) > input').type('2023-12-10');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(2) > input').type('2024-02-20');
        cy.get('#newSemesterModal > div > div > div > button').click();
        cy.contains('A megadott dátumok átfedésben vannak egy már létező félévvel');
    });
});
