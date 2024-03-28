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

});