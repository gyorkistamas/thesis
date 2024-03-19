package org.example;

import static io.gatling.javaapi.core.CoreDsl.RawFileBody;
import static io.gatling.javaapi.core.CoreDsl.StringBody;
import static io.gatling.javaapi.core.CoreDsl.atOnceUsers;
import static io.gatling.javaapi.core.CoreDsl.css;
import static io.gatling.javaapi.core.CoreDsl.pause;
import static io.gatling.javaapi.core.CoreDsl.regex;
import static io.gatling.javaapi.core.CoreDsl.scenario;
import static io.gatling.javaapi.http.HttpDsl.http;
import static io.gatling.javaapi.http.HttpDsl.status;

import java.util.Map;

import io.gatling.javaapi.core.ScenarioBuilder;
import io.gatling.javaapi.core.Simulation;
import io.gatling.javaapi.http.HttpProtocolBuilder;

public class TimeTableSimulation extends Simulation {

    private HttpProtocolBuilder httpProtocol = http
            .baseUrl("https://szakdolgozat.ddns.net")
            .inferHtmlResources()
            .acceptHeader("*/*")
            .acceptEncodingHeader("gzip, deflate, br")
            .acceptLanguageHeader("hu-HU,hu;q=0.8,en-US;q=0.5,en;q=0.3")
            .doNotTrackHeader("1")
            .userAgentHeader("Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123.0");

    private Map<CharSequence, String> headers_1 = Map.ofEntries(
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
            Map.entry("Cache-Control", "no-cache"),
            Map.entry("Pragma", "no-cache"),
            Map.entry("Sec-Fetch-Dest", "serviceworker"),
            Map.entry("Sec-Fetch-Mode", "same-origin"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("Service-Worker", "script")
    );

    private Map<CharSequence, String> headers_5 = Map.ofEntries(
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin")
    );

    private Map<CharSequence, String> headers_8 = Map.ofEntries(
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("X-Livewire-Navigate", "")
    );

    private Map<CharSequence, String> headers_9 = Map.ofEntries(
            Map.entry("Accept", "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8"),
            Map.entry("Origin", "https://szakdolgozat.ddns.net"),
            Map.entry("Sec-Fetch-Dest", "document"),
            Map.entry("Sec-Fetch-Mode", "navigate"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("Sec-Fetch-User", "?1"),
            Map.entry("Upgrade-Insecure-Requests", "1")
    );

    private Map<CharSequence, String> headers_15 = Map.ofEntries(
            Map.entry("Content-type", "application/json"),
            Map.entry("Origin", "https://szakdolgozat.ddns.net"),
            Map.entry("Sec-Fetch-Dest", "empty"),
            Map.entry("Sec-Fetch-Mode", "cors"),
            Map.entry("Sec-Fetch-Site", "same-origin"),
            Map.entry("X-Livewire", ""),
            Map.entry("X-Socket-ID", "undefined")
    );

    private String uri2 = "https://encrypted-tbn0.gstatic.com/images";

    private String uri3 = "https://www.google.com/complete/search";

    private ScenarioBuilder scn = scenario("TimeTableSimulation")
            .exec(
                    http("Google search")
                            .get(uri3 + "?client=firefox&q=szak&channel=fen")
                            .resources(
                                    http("Gravatar")
                                            .get(uri2 + "?q=tbn:ANd9GcTBSGAdJwI24aaLX6dmlrZB5nMhJ2I_eau9kg0TzhaEOR3da9eeUlb4i1l9ew&s=10")
                                            .headers(headers_1),
                                    http("Gravatar")
                                            .get(uri2 + "?q=tbn:ANd9GcTTemvUVLw_DTBSXz7pHsaoycnhp23bIna5m9ByEhA6-g&s=10")
                                            .headers(headers_1),
                                    http("Main page")
                                            .get("/")
                                            .headers(headers_3),
                                    http("Service worker")
                                            .get("/serviceworker.js")
                                            .headers(headers_4),
                                    http("Offline")
                                            .get("/offline")
                                            .headers(headers_5),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_5)
                                            .check(status().is(404)),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_5)
                                            .check(status().is(404)),
                                    http("Login")
                                            .get("/login")
                                            .headers(headers_8)
                                            .check(css("[name=\"_token\"]", "value").saveAs("csrflogin"))
                                    ),
                    pause(8),
                    http("Login POST")
                            .post("/login")
                            .headers(headers_9)
                            .formParam("_token", "#{csrflogin}")
                            .formParam("email", "TEACHE")
                            .formParam("password", "teacher")
                            .resources(
                                    http("Service worker")
                                            .get("/serviceworker.js")
                                            .headers(headers_4),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_5)
                                            .check(status().is(404)),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_5)
                                            .check(status().is(404)),
                                    http("Offline")
                                            .get("/offline")
                                            .headers(headers_5)
                            ),
                    pause(3),
                    http("Timetable")
                            .get("/timetable")
                            .headers(headers_8)
                            .check(css("script[data-csrf]", "data-csrf").saveAs("livewirecsrf"))
                            .check(css("[name=\"_token\"]", "value").saveAs("csrflogout"))
                            .resources(
                                    http("LiveWire update")
                                            .post("/livewire/update")
                                            .headers(headers_15)
                                            .body(StringBody("{\n" +
                                                    "  \"_token\": \"#{livewirecsrf}\",\n" +
                                                    "  \"components\": [\n" +
                                                    "    {\n" +
                                                    "      \"snapshot\": \"{\\\"data\\\":{\\\"user\\\":[null,{\\\"class\\\":\\\"App\\\\\\\\Models\\\\\\\\User\\\",\\\"key\\\":3,\\\"s\\\":\\\"mdl\\\"}]},\\\"memo\\\":{\\\"id\\\":\\\"PyyPHmD3cXNgud0DML4j\\\",\\\"name\\\":\\\"landing.timetable\\\",\\\"path\\\":\\\"timetable\\\",\\\"method\\\":\\\"GET\\\",\\\"children\\\":[],\\\"scripts\\\":[\\\"4181131285-0\\\"],\\\"assets\\\":[],\\\"errors\\\":[],\\\"locale\\\":\\\"hu\\\"},\\\"checksum\\\":\\\"3e9c8b51c1e30fc21b166a922ba03ef282f2fc2957fde9259c81146d0a5b3229\\\"}\",\n" +
                                                    "      \"updates\": {},\n" +
                                                    "      \"calls\": [\n" +
                                                    "        {\n" +
                                                    "          \"path\": \"\",\n" +
                                                    "          \"method\": \"getEvents\",\n" +
                                                    "          \"params\": [\n" +
                                                    "            \"2024-03-18T00:00:00+01:00\",\n" +
                                                    "            \"2024-03-25T00:00:00+01:00\"\n" +
                                                    "          ]\n" +
                                                    "        }\n" +
                                                    "      ]\n" +
                                                    "    }\n" +
                                                    "  ]\n" +
                                                    "}"))
                            ),
                    pause(9),
                    http("Logout")
                            .post("/logout")
                            .headers(headers_9)
                            .formParam("_token", "#{csrflogout}")
                            .resources(
                                    http("Service worker")
                                            .get("/serviceworker.js")
                                            .headers(headers_4),
                                    http("offline")
                                            .get("/offline")
                                            .headers(headers_5),
                                    http("CSS")
                                            .get("/assets/build/app.css")
                                            .headers(headers_5)
                                            .check(status().is(404)),
                                    http("JS")
                                            .get("/assets/build/app.js")
                                            .headers(headers_5)
                                            .check(status().is(404))
                            )
            );

    {
        setUp(scn.injectOpen(atOnceUsers(5))).protocols(httpProtocol);
    }
}
