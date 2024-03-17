describe('Logging in with users', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();
    });

    it('Logs in with super admin', () => {
        cy.visit('/')
        cy.get('.align-top > .btn').click()
        cy.get('[type="text"]').type('SADMIN')
        cy.get('.flex-col > .mt-3').type('superadmin')
        cy.get('.flex-wrap > .btn').click()
        cy.contains('Oldal adminisztráció')
    })

    it('Logs in with admin', () => {
        cy.visit('/')
        cy.get('.align-top > .btn').click()
        cy.get('[type="text"]').type('ADMIN0')
        cy.get('.flex-col > .mt-3').type('admin')
        cy.get('.flex-wrap > .btn').click()
        cy.contains('Adminisztráció')
    })

    it('Logs in with teacher', () => {
        cy.visit('/')
        cy.get('.align-top > .btn').click()
        cy.get('[type="text"]').type('TEACHE')
        cy.get('.flex-col > .mt-3').type('teacher')
        cy.get('.flex-wrap > .btn').click()
        cy.contains('Oktatott')
    })

    it('Logs in with student', () => {
        cy.visit('/')
        cy.get('.align-top > .btn').click()
        cy.get('[type="text"]').type('STUDEN')
        cy.get('.flex-col > .mt-3').type('student')
        cy.get('.flex-wrap > .btn').click()
        cy.contains('Tantárgyaim')
    })
})
