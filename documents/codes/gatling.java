public class LogClassStatus extends Simulation {

	private ScenarioBuilder scn = scenario("LogClassStatus")
		.exec(
			http("Login get")
				.get("/login")
				.headers(headers_15)
				.check(css("[name=\"_token\"]", "value").saveAs("csrflogin")),
			pause(6),
			http("Login post")
				.post("/login")
				.headers(headers_16)
				.formParam("_token", "#{csrflogin}")
				.formParam("email", "TEACHE")
				.formParam("password", "teacher")
			);

	{
	 setUp(scn.injectOpen(atOnceUsers(10))).protocols(httpProtocol);
	}

}