package org.example;

import static io.gatling.javaapi.core.CoreDsl.ElFileBody;
import static io.gatling.javaapi.core.CoreDsl.atOnceUsers;
import static io.gatling.javaapi.core.CoreDsl.css;
import static io.gatling.javaapi.core.CoreDsl.pause;
import static io.gatling.javaapi.core.CoreDsl.scenario;
import static io.gatling.javaapi.http.HttpDsl.http;
import static io.gatling.javaapi.http.HttpDsl.status;

import java.util.Map;

import io.gatling.javaapi.core.ScenarioBuilder;
import io.gatling.javaapi.core.Simulation;
import io.gatling.javaapi.http.HttpProtocolBuilder;

public class LogClassStatus extends Simulation {

    private HttpProtocolBuilder httpProtocol = http
            .baseUrl("https://szakdolgozat.ddns.net")
            .inferHtmlResources()
            .acceptHeader("*/*")
            .acceptEncodingHeader("gzip, deflate, br")
            .acceptLanguageHeader("hu-HU,hu;q=0.8,en-US;q=0.5,en;q=0.3")
            .doNotTrackHeader("1")
            .userAgentHeader("Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123.0");

    private Map<CharSequence, String> headers_2 = Map.ofEntries(
            Map.entry("Accept", "image/avif,image/webp,*/*"),
            Map.entry("Sec-Fetch-Dest", "image"),
            Map.entry("Sec-Fetch-Mode", "no-cors"),
            Map.entry("Sec-Fetch-Site", "cross-site")
    );

    private Map<CharSequence, String> headers_3 = Map.ofEntries(
            Map.entry("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8"),
            Map.entry("Sec-Fetch-Dest", "document"),
            Map.entry("Sec-Fetch-Mode", "navigate"),
            Map.entry("Sec-Fetch-Site", "none"),
            Map.entry("Sec-Fetch-User", "?1"),
            Map.entry("Upgrade-Insecure-Requests", "1")
    );

    private Map<CharSequence, String> headers_4 = Map.ofEntries(
            Map.entry("Accept", "text/css,*/*;q=0.1"),
            Map.entry("Sec-Fetch-Dest", "style"),
            Map.entry("Sec-Fetch-Mode", "no-cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_6 = Map.ofEntries(
            Map.entry("If-Modified-Since", "Tue, 19 Mar 2024 19:59:36 GMT"),
            Map.entry("If-None-Match", "W/\"65f9eea8-1b008\""),
            Map.entry("Sec-Fetch-Dest", "script"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_7 = Map.ofEntries(
            Map.entry("Accept", "image/avif,image/webp,*/*"),
            Map.entry("If-Modified-Since", "Sun, 17 Mar 2024 17:09:52 GMT"),
            Map.entry("If-None-Match", "\"65f723e0-4785a\""),
            Map.entry("Sec-Fetch-Dest", "image"),
            Map.entry("Sec-Fetch-Mode", "no-cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_8 = Map.ofEntries(
            Map.entry("Accept", "text/css,*/*;q=0.1"),
            Map.entry("Sec-Fetch-Dest", "style"),
            Map.entry("Sec-Fetch-Mode", "no-cors"),
            Map.entry("Sec-Fetch-Site", "cross-site")
    );

    private Map<CharSequence, String> headers_9 = Map.ofEntries(
            Map.entry("Cache-Control", "no-cache"),
            Map.entry("Pragma", "no-cache"),
            Map.entry("Sec-Fetch-Dest", "serviceworker"),
            Map.entry("Sec-Fetch-Mode", "same-origin"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("Service-Worker", "script")
    );

    private Map<CharSequence, String> headers_10 = Map.ofEntries(
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_11 = Map.ofEntries(
            Map.entry("If-Modified-Since", "Sun, 17 Mar 2024 17:09:52 GMT"),
            Map.entry("If-None-Match", "\"65f723e0-31399\""),
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_15 = Map.ofEntries(
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("X-Livewire-Navigate", "")
    );

    private Map<CharSequence, String> headers_16 = Map.ofEntries(
            Map.entry("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8"),
            Map.entry("Origin", "https://szakdolgozat.ddns.net"),
            Map.entry("Sec-Fetch-Dest", "document"),
            Map.entry("Sec-Fetch-Mode", "navigate"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("Sec-Fetch-User", "?1"),
            Map.entry("Upgrade-Insecure-Requests", "1")
    );

    private Map<CharSequence, String> headers_22 = Map.ofEntries(
            Map.entry("Content-type", "application/json"),
            Map.entry("Origin", "https://szakdolgozat.ddns.net"),
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("X-Livewire", ""),
            Map.entry("X-Socket-ID", "undefined")
    );

    private String uri2 = "https://encrypted-tbn0.gstatic.com/images";

    private String uri5 = "https://fonts.googleapis.com/css2";

    private ScenarioBuilder scn = scenario("LogClassStatus")
            .exec(
                    http("Gravatar")
                            .get(uri2 + "?q=tbn:ANd9GcRkQ_lnJ4ef12n9yZpk4bbcdqg9xKnDA8YCM0Rz09Ea_b1x8mkvdsHgWaUyqA&s=10")
                            .headers(headers_2),
                    http("Landing")
                            .get("/")
                            .headers(headers_3),
                    http("CSS")
                            .get("/build/assets/app-302bca7b.css")
                            .headers(headers_4),
                    http("CSS")
                            .get("/build/assets/themeswitcher-ef230a1e.css")
                            .headers(headers_4),
                    http("JS")
                            .get("/build/assets/app-cf7df52f.js")
                            .headers(headers_6),
                    http("Logo")
                            .get("/def_logo.png")
                            .headers(headers_7),
                    http("Font")
                            .get(uri5 + "?family=Roboto:wght@300;400&display=swap")
                            .headers(headers_8),
                    http("Service worker")
                            .get("/serviceworker.js")
                            .headers(headers_9),
                    http("Offline")
                            .get("/offline")
                            .headers(headers_10),
                    http("Logo")
                            .get("/rsz_def_logo.png")
                            .headers(headers_11),
                    http("CSS")
                            .get("/assets/build/app.css")
                            .headers(headers_10)
                            .check(status().is(404)),
                    http("JS")
                            .get("/assets/build/app.js")
                            .headers(headers_10)
                            .check(status().is(404)),
                    http("Offline")
                            .get("/offline.html")
                            .headers(headers_10),
                    pause(1),
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
                            .resources(
                                    http("Service worker")
                                            .get("/serviceworker.js")
                                            .headers(headers_9),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_10)
                                            .check(status().is(404)),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_10)
                                            .check(status().is(404)),
                                    http("Offline")
                                            .get("/offline")
                                            .headers(headers_10)
                            ),
                    pause(1),
                    http("Subjects")
                            .get("/teacher-subjects")
                            .headers(headers_15)
                            .check(css("script[data-csrf]", "data-csrf").saveAs("livewirecsrf"))
                            .check(css("[name=\"_token\"]", "value").saveAs("csrflogout"))
                            .resources(
                                    http("Livewire - subjects update")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0022_request.json"))
                            ),
                    pause(1),
                    http("Livewire update")
                            .post("/livewire/update")
                            .headers(headers_22)
                            .body(ElFileBody("org/example/logclassstatus/0023_request.json")),
                    pause(1),
                    http("Livewire update")
                            .post("/livewire/update")
                            .headers(headers_22)
                            .body(ElFileBody("org/example/logclassstatus/0024_request.json")),
                    pause(2),
                    http("Navigate to class")
                            .get("/teacher-class/51")
                            .headers(headers_15),
                    pause(2),
                    http("Livewire - set attendance")
                            .post("/livewire/update")
                            .headers(headers_22)
                            .body(ElFileBody("org/example/logclassstatus/0026_request.json"))
                            .resources(
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0027_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0028_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0029_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0030_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0031_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0032_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0033_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0034_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0035_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0036_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0037_request.json"))
                            ),
                    pause(1),
                    http("Livewire - set attendance")
                            .post("/livewire/update")
                            .headers(headers_22)
                            .body(ElFileBody("org/example/logclassstatus/0038_request.json"))
                            .resources(
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0039_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0040_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0041_request.json"))
                            ),
                    pause(1),
                    http("Livewire - set attendance")
                            .post("/livewire/update")
                            .headers(headers_22)
                            .body(ElFileBody("org/example/logclassstatus/0042_request.json"))
                            .resources(
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0043_request.json")),
                                    http("Livewire - set attendance")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0044_request.json")),
                                    http("Livewire - refresh chart")
                                            .post("/livewire/update")
                                            .headers(headers_22)
                                            .body(ElFileBody("org/example/logclassstatus/0045_request.json"))
                            ),
                    pause(4),
                    http("Logout post")
                            .post("/logout")
                            .headers(headers_16)
                            .formParam("_token", "#{csrflogout}")
                            .resources(
                                    http("Service worker")
                                            .get("/serviceworker.js")
                                            .headers(headers_9),
                                    http("Offline")
                                            .get("/offline")
                                            .headers(headers_10),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_10)
                                            .check(status().is(404)),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_10)
                                            .check(status().is(404))
                            )
            );

    {
        setUp(scn.injectOpen(atOnceUsers(5))).protocols(httpProtocol);
    }
}
