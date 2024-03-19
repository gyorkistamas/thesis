/// <reference types="Cypress" />

describe('Testing places', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();

        cy.login({neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(2) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.min-w-full.max-w-full.md\\:flex-row.justify-center.md\\:justify-between > button').click();
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-col.items-center > div > input').type('Test semester');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(1) > input').type('2024-01-01');
        cy.get('#newSemesterModal > div > div > form > div.flex.flex-row.justify-between > div:nth-child(2) > input').type('2024-10-01');
        cy.get('#newSemesterModal > div > div > div > button').click();

        cy.login({neptun: 'ADMIN0'});
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

        cy.login({neptun: 'ADMIN0'});
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

        cy.login({neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(3)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(4) > div:nth-child(2) > div.prose.mb-3.flex.flex-col.flex-wrap.justify-center.min-w-full.max-w-full.md\\:flex-row.md\\:justify-between > button').click();
        cy.get('#newPlaceModal > div > div > form > div > div > input').type('Test place');
        cy.get('#newPlaceModal > div > div > div > button').click();

        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > input[type=checkbox]').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > div.collapse-content.overflow-visible > div.mt-5 > div:nth-child(2) > table > tbody > tr:nth-child(1) > td:nth-child(4) > div > label').click();
        cy.get('body > div:nth-child(4) > div > div > div.tabs.tabs-lifted > input:nth-child(3)').click();
        cy.get('body > div:nth-child(4) > div > div > div.tabs.tabs-lifted > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(1) > input').type('2024-03-10T10:00:00');
        cy.get('body > div:nth-child(4) > div > div > div.tabs.tabs-lifted > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(2) > input').type('2024-03-10T12:00:00');
        cy.get('body > div:nth-child(4) > div > div > div.tabs.tabs-lifted > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(3) > div > div > input').type('t');
        cy.get('body > div:nth-child(4) > div > div > div.tabs.tabs-lifted > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(3) > div > div > div > div > div > div > a').click();
        cy.wait(5000);
        cy.get('body > div:nth-child(4) > div > div > div.tabs.tabs-lifted > div:nth-child(4) > table > tbody > tr:nth-child(1) > td:nth-child(4) > button').click();
    });

    it('Add student to course', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > input[type=checkbox]').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > div.collapse-content.overflow-visible > div.mt-5 > div:nth-child(2) > table > tbody > tr > td:nth-child(4) > div > label').click();
        cy.get('body > div.drawer.z-\\[222\\] > div > div > div.tabs.tabs-lifted > input:nth-child(5)').click();
        cy.get('body > div.drawer.z-\\[222\\] > div > div > div.tabs.tabs-lifted > div:nth-child(6) > div > div > div > input').type('STUDEN');
        cy.get('body > div.drawer.z-\\[222\\] > div > div > div.tabs.tabs-lifted > div:nth-child(6) > div > div > div > div > div > div > div > a').click();
        cy.wait(2000);
        cy.get('body > div.drawer.z-\\[222\\] > div > div > div.tabs.tabs-lifted > div:nth-child(6) > div > button').click();
        cy.contains('Siker');
        cy.php(`
            App\\Models\\Attendance::count();
        `).then(count => {
            expect(count).to.eq(1);
        });
    });

    it('Can\'t add the same student to course', () => {
        cy.login({ neptun: 'ADMIN0'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(3) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > input:nth-child(5)').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > input[type=checkbox]').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div:nth-child(6) > div:nth-child(2) > div.mt-4 > div:nth-child(1) > div > div.collapse-content.overflow-visible > div.mt-5 > div:nth-child(2) > table > tbody > tr > td:nth-child(4) > div > label').click();
        cy.get('body > div.drawer.z-\\[222\\] > div > div > div.tabs.tabs-lifted > input:nth-child(5)').click();
        cy.get('body > div.drawer.z-\\[222\\] > div > div > div.tabs.tabs-lifted > div:nth-child(6) > div > div > div > input').type('STUDEN');
        cy.wait(2000);
        cy.contains('Nincs találat');
    });

});
