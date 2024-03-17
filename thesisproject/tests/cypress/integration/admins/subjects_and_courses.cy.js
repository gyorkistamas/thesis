/// <reference types="Cypress" />

describe('Testing places', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(2) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.min-w-full.max-w-full.md\\:flex-row.justify-center.md\\:justify-between > button').click();
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-col.items-center > div > input').type('Test semester');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(1) > input').type('2024-01-01');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(2) > input').type('2024-10-01');
        cy.get('#newSemesterModal > div > div > div > button').click();
        cy.contains('Siker');
    });

    it('Creates a new subject', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.prose.mb-3.flex.flex-row.flex-wrap.justify-between.min-w-full.max-w-full.md\\:flex-row > button').click();
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(1) > input').type('NBT_TEST');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(2) > input').type('Test subject');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(3) > input').type('Test subject description');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(4) > input').type('3');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(5) > div > div > input').type('Teacher');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(5) > div > div > div > div > div > div > a').click();
        cy.get('#subjectCreateModal > div > div > div.flex.flex-row.gap-3.mt-5.justify-end > a').click();
        cy.contains('Siker');
    });

    it('Failes to create a subject with same code', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.prose.mb-3.flex.flex-row.flex-wrap.justify-between.min-w-full.max-w-full.md\\:flex-row > button').click();
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(1) > input').type('NBT_TEST');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(2) > input').type('Test subject');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(3) > input').type('Test subject description');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(4) > input').type('3');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(5) > div > div > input').type('Teacher');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(5) > div > div > div > div > div > div > a').click();
        cy.get('#subjectCreateModal > div > div > div.flex.flex-row.gap-3.mt-5.justify-end > a').click();
        cy.contains('Ez az érték már foglalt, használjon másikat.');
    });

    it('Creates a course for the subject', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();

        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > input[type=checkbox]').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > div.collapse-content.overflow-visible > div.mt-5 > div.prose.mb-3.flex.flex-row.flex-wrap.justify-between.min-w-full.max-w-full.md\\:flex-row > div > button').click();

        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > input:nth-child(2)').type('A');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > input:nth-child(4)').type('Description');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > input:nth-child(6)').type('10');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > div:nth-child(8) > div > input').type('Teacher');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > div:nth-child(8) > div > div > div > div > div > a').click();
        cy.get('#createCourseNBT_TEST > div > div.modal-action > button').click();
        cy.contains('Siker');
    });

    it('Creates a course with the same code for a different subject', () => {
        cy.login({ neptun: 'ADMIN0'});

        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.prose.mb-3.flex.flex-row.flex-wrap.justify-between.min-w-full.max-w-full.md\\:flex-row > button').click();
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(1) > input').type('NBT_TEST2');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(2) > input').type('Test subject');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(3) > input').type('Test subject description');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(4) > input').type('3');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(5) > div > div > input').type('Teacher');
        cy.get('#subjectCreateModal > div > div > div:nth-child(1) > div:nth-child(5) > div > div > div > div > div > div > a').click();
        cy.get('#subjectCreateModal > div > div > div.flex.flex-row.gap-3.mt-5.justify-end > a').click();


        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();

        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(2) > div > input[type=checkbox]').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(2) > div > div.collapse-content.overflow-visible > div.mt-5 > div.prose.mb-3.flex.flex-row.flex-wrap.justify-between.min-w-full.max-w-full.md\\:flex-row > div > button').click();

        cy.get('#createCourseNBT_TEST2 > div > div:nth-child(2) > input:nth-child(2)').type('A');
        cy.get('#createCourseNBT_TEST2 > div > div:nth-child(2) > input:nth-child(4)').type('Description');
        cy.get('#createCourseNBT_TEST2 > div > div:nth-child(2) > input:nth-child(6)').type('10');
        cy.get('#createCourseNBT_TEST2 > div > div:nth-child(2) > div:nth-child(8) > div > input').type('Teacher');
        cy.get('#createCourseNBT_TEST2 > div > div:nth-child(2) > div:nth-child(8) > div > div > div > div > div > a').click();
        cy.get('#createCourseNBT_TEST2 > div > div.modal-action > button').click();
        cy.contains('Siker');
    });

    it('Fails to create a new course with the same course code for subject', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();

        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > input[type=checkbox]').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > div.collapse-content.overflow-visible > div.mt-5 > div.prose.mb-3.flex.flex-row.flex-wrap.justify-between.min-w-full.max-w-full.md\\:flex-row > div > button').click();

        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > input:nth-child(2)').type('A');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > input:nth-child(4)').type('Description');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > input:nth-child(6)').type('10');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > div:nth-child(8) > div > input').type('Teacher');
        cy.get('#createCourseNBT_TEST > div > div:nth-child(2) > div:nth-child(8) > div > div > div > div > div > a').click();
        cy.get('#createCourseNBT_TEST > div > div.modal-action > button').click();
        cy.contains('Ez az érték már foglalt, használjon másikat.');
    });
});
