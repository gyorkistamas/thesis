package org.example;

import static io.gatling.javaapi.core.CoreDsl.atOnceUsers;
import static io.gatling.javaapi.core.CoreDsl.css;
import static io.gatling.javaapi.core.CoreDsl.pause;
import static io.gatling.javaapi.core.CoreDsl.scenario;
import static io.gatling.javaapi.core.CoreDsl.xpath;
import static io.gatling.javaapi.http.HttpDsl.http;
import static io.gatling.javaapi.http.HttpDsl.status;

import java.util.Map;

import io.gatling.javaapi.core.ScenarioBuilder;
import io.gatling.javaapi.core.Simulation;
import io.gatling.javaapi.http.HttpProtocolBuilder;

public class LoginSimulation extends Simulation {

    private HttpProtocolBuilder httpProtocol = http
            .baseUrl("https://szakdolgozat.ddns.net")
            .inferHtmlResources()
            .acceptHeader("*/*")
            .acceptEncodingHeader("gzip, deflate, br")
            .acceptLanguageHeader("hu-HU,hu;q=0.8,en-US;q=0.5,en;q=0.3")
            .doNotTrackHeader("1")
            .userAgentHeader("Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0");

    private Map<CharSequence, String> headers_0 = Map.ofEntries(
            Map.entry("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8"),
            Map.entry("Accept-Encoding", "gzip, deflate"),
            Map.entry("Upgrade-Insecure-Requests", "1")
    );

    private Map<CharSequence, String> headers_1 = Map.ofEntries(
            Map.entry("Cache-Control", "no-cache"),
            Map.entry("Pragma", "no-cache"),
            Map.entry("Sec-Fetch-Dest", "serviceworker"),
            Map.entry("Sec-Fetch-Mode", "same-origin"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("Service-Worker", "script")
    );

    private Map<CharSequence, String> headers_2 = Map.ofEntries(
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_6 = Map.ofEntries(
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("X-Livewire-Navigate", "")
    );

    private Map<CharSequence, String> headers_7 = Map.ofEntries(
            Map.entry("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8"),
            Map.entry("Origin", "https://szakdolgozat.ddns.net"),
            Map.entry("Sec-Fetch-Dest", "document"),
            Map.entry("Sec-Fetch-Mode", "navigate"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("Sec-Fetch-User", "?1"),
            Map.entry("Upgrade-Insecure-Requests", "1")
    );

    private String uri1 = "szakdolgozat.ddns.net";

    private ScenarioBuilder scn = scenario("LoginSimulation")
            .exec(
                    http("Main page")
                            .get("http://" + uri1 + "/")
                            .headers(headers_0)
                            .resources(
                                    http("ServiceWorker")
                                            .get("/serviceworker.js")
                                            .headers(headers_1),
                                    http("OfflinePage")
                                            .get("/offline")
                                            .headers(headers_2),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_2)
                                            .check(status().is(404)),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_2)
                                            .check(status().is(404)),
                                    http("OfflinePage")
                                            .get("/offline.html")
                                            .headers(headers_2)
                            ),
                    pause(2),
                    http("LoginPage")
                            .get("/login")
                            .headers(headers_6)
                            .check(css("[name=\"_token\"]", "value").saveAs("csrf")),
                    pause(8),
                    http("PostLogin")
                            .post("/login")
                            .headers(headers_7)
                            .formParam("_token", "#{csrf}")
                            .formParam("email", "admin0")
                            .formParam("password", "admin")
                            .resources(
                                    http("ServiceWorker")
                                            .get("/serviceworker.js")
                                            .headers(headers_1),
                                    http("OfflinePage")
                                            .get("/offline")
                                            .headers(headers_2),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_2)
                                            .check(status().is(404)),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_2)
                                            .check(status().is(404))
                            )
            );

    {
        setUp(scn.injectOpen(atOnceUsers(5))).protocols(httpProtocol);
    }
}
