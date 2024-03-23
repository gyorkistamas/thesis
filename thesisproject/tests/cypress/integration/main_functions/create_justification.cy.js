describe('Testing justification creation', () => {

    before(() => {
        cy.refreshDatabase();
        cy.seed();
    });

    it("Creates a justification", () => {
        cy.login({ neptun: 'STUDEN'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(4) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div.flex.flex-row.justify-between.items-center > label').click();

        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-col.items-center.gap-3.md\\:flex-row.md\\:justify-start.md\\:gap-10.md\\:items-start > div:nth-child(2) > label > input').type('2021-05-05T10:00:00');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-col.items-center.gap-3.md\\:flex-row.md\\:justify-start.md\\:gap-10.md\\:items-start > div:nth-child(3) > label > input').type('2021-05-10T10:00:00');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div:nth-child(2) > div > label > textarea').type('Test');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-row.justify-center.md\\:justify-end > button').click();
        cy.contains('Siker');
    });

    it("Uploads picture to the justification", () => {
        cy.login({ neptun: 'STUDEN'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(4) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div.flex.flex-row.justify-between.items-center > label').click();

        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-col.items-center.gap-3.md\\:flex-row.md\\:justify-start.md\\:gap-10.md\\:items-start > div:nth-child(2) > label > input').type('2021-05-05T10:00:00');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-col.items-center.gap-3.md\\:flex-row.md\\:justify-start.md\\:gap-10.md\\:items-start > div:nth-child(3) > label > input').type('2021-05-10T10:00:00');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div:nth-child(2) > div > label > textarea').type('Test');

        cy.get('#fileUpload').selectFile({
            contents: 'test.png',
            fileName: 'test.png',
            mimeType: 'image/png'
        });
        cy.wait(5000);
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div:nth-child(3) > div:nth-child(1) > div.flex.md\\:flex-row.gap-2.md\\:items-end.flex-col.justify-center.md\\:justify-start > button').click();
        cy.wait(2000);

        cy.contains('test.png');

        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-row.justify-center.md\\:justify-end > button').click();
        cy.contains('Siker');

    })


    it('Cannot create a justification with invalid date', () => {
        cy.login({ neptun: 'STUDEN'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(4) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div.flex.flex-row.justify-between.items-center > label').click();

        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-col.items-center.gap-3.md\\:flex-row.md\\:justify-start.md\\:gap-10.md\\:items-start > div:nth-child(2) > label > input').type('2021-05-05T10:00:00');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-col.items-center.gap-3.md\\:flex-row.md\\:justify-start.md\\:gap-10.md\\:items-start > div:nth-child(3) > label > input').type('2021-04-10T10:00:00');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div:nth-child(2) > div > label > textarea').type('Test');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-row.justify-center.md\\:justify-end > button').click();
        cy.contains('A mező értékének a start után kell lennie.');
    });

    it('Cannot create a justification with no date', () => {
        cy.login({ neptun: 'STUDEN'});
        cy.visit('/');
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-content.flex.flex-col > div > div.flex-none.lg\\:hidden > label').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.drawer > div.drawer-side.z-\\[9999\\] > ul > li:nth-child(4) > a').click();
        cy.get('body > div.backdrop-blur-\\[1\\.5px\\].min-h-screen > div.mx-3 > div > div > div.flex.flex-row.justify-between.items-center > label').click();

        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div:nth-child(2) > div > label > textarea').type('Test');
        cy.get('body > div.drawer.z-\\[200\\] > div > div > div.grid.grid-cols-1.xl\\:grid-cols-2.gap-5.xl\\:gap-12 > div.flex.flex-col.gap-5.col-span-1 > div.flex.flex-row.justify-center.md\\:justify-end > button').click();
        cy.contains('A mezőt kötelező megadni.');
    });
});
