<?php
if ($lang=='deu') {
?>
<h3>Über dieses Projekt</h3>
<p>
Diese Datenbank ist entstanden aus einem privaten Inhaltsverzeichnis mit einzelnen Konkordanzen, das Peter Steur schon für eine grosse Anzahl von Quellen erstellt hatte. 2007 schickte ihm Markus Lutz seine Zusammenstellung der Werke von Weiss mit Konkordanzen zu um die Konkordanzen zu überprüfen, was Peter Steur zum Anlass nahm, seine Informationen zu systematisieren. Markus Lutz schlug darauf hin vor, all dieses Material weltweit verfügbar zu machen unter der URL <i>mss.slweiss.de</i>. Markus kümmerte sich um Gestaltung, Programmierung und Betrieb der Webseite und steuerte gelegentlich Konkordanzen und Incipits bei, während Peter die Inhalte weiter systematisch ergänzte und korrigierte.
</p>
<p>Mit dem Tod von Markus Lutz im Jahr 2023 drohte die nicht mehr weiter gepflegte Webseite offline zu gehen. Nachdem sie Opfer eines Hackerangriffs wurde, hat Christoph Dalitz sie rekonstruiert und zunächst im Auftrag der Witwe von Markus Lutz wieder in Betrieb genommen. Im Jahr 2024 hat dann die Deutsche Lautengesellschaft den Webhosting-Vertrag der Seite und ihren Betrieb übernommen. Die Inhalte werden weiterhin von Peter Steur gepflegt und ergänzt und Christoph Dalitz kümmert sich um die Pflege der Gestaltung und Programmierung der Webseite. Ferner hat er das github-Projekt <a href="https://github.com/cdalitz/lute-manuscripts" target="_blank">lute-manuscripts</a>
  eingerichtet, das Inhalte und Code der Webseite unter der GNU General Public License dauerhaft verfügbar macht.
</p>
<h4>Quellen der Konkordanzen</h4>
<p>Konkordanzen, die nicht von Markus Lutz kamen, stammen aus folgenden Quellen:
</p>
<ul>
<li>Aus den Aufstellungen in den Editionen der CLF Editionen der Werke von V.Gaultier, Mesangeau und Dufault.</li>
<li>Aus handschriftlichen Anmerkungen von F.-P. Goy, in den im Tausch erhaltenen Mss.</li>
<li>Für die Übergangsstimmungen (Accords Nouveaux) konnte ich dankenswerterweise den neuen Katalog Accords nouveaux von François-Pierre Goy & Andreas Schlegel benutzen, der auch einige neue Konkordanzen enthielt. Die Übergangsstimmungen sind direkt hinter der Tonart durch ein Kürzel des Stimmungs-Typs von François-Pierre Goy angegeben (blau in Klammern). Unter der Tonart steht außerdem die PAN-Nummer (pièces en accords nouveaux). Die Kürzel sind auf der Web-Seite Accords nouveaux erklärt.</li>
<li>Von der Online-Version des Kataloges von Meyer (Univ. Straßburg), jetzt aufgegeben.</li>
<li>Auflistungen von Tim Crawford, vor allem für folgende Manuskripte: Mss Danby, Wn396, GoëssI und GoëssII.</li>
<li>Meinen eigenen Entdeckungen, von denen manche erst bei Erstellung dieser Datenbank zutage traten,</li>
<li>gelegentliche Hinweise von andere Personen (sehr geschätzt!)</li>
</ul>
<p>
  Zur Zeit enthält die Datenbank Einträge von mehr als 1000 Quellen, die unter Umständen nicht immer vollständig sind. Da die Datenbank ursprünglich für den Hausgebrauch erstellt wurde, kann es sein, dass Quellen noch inkonsistent bezeichnet werden, z.B. standen lange Zeit "Reynaud" und "F-Aix" noch nebeneinander. Am Anfang wurde nur das Barock-Material berücksichtigt, aber aufgrund von Nutzeranfragen ist das Material teilwiese auch erweitert um Quellen für Renaissancelaute, Mandora und Zister. Eine weitere Ergänzung könnten Kammermusik-Werke mit Laute sein. Jede konstruktive Mithilfe bei der Ergänzung des Material ist willkommen.
</p>

<h4>Struktur der Datenbank</h4>
<p>Eine eingehende Diskussion über die Struktur der Datenbank wurde schon mehrmals veröffentlicht, also wird hier nur eine abgekürzte Version gegeben. Sie basiert sich wesentlich auf drei *csv-Datei-Typen:
</p>
<ul>
  <li>eine mit der Beschreibung der Quellen (<i>MssNames.csv</i>)</li>
  <li>eine mit den Konkordanzen (<i>Concordances.csv</i>)</li>
  <li>je Quelle eine Datei mit den Informationen der einzelnen Stücke mitsamt den Inzipits.</li>
</ul>
<p>Die Konkordanz-Nummer kommen in zwei Gruppen: für die Baroklaute - wo die Nummer vorausgegangen werden durch das Zeichen "_", und für die Renaissancelaute - wo die Numnmer vorausgegangen werden durch das Zeichen "R". Diese Unterschied is nicht rigoros weil mehrere Stücke in beide Perioden gefunden werden. Die Inzipits (jetzt etwa 65000) sind als Text kodiert im Tabulaturcode des Notensatzprogramms abctab2ps. Die Web-Oberfläche enthält auch eine Such-Option für die Inzipits, womit womöglich neue Konkordanzen gefunden werden können.
</p>
<p>Detaillierte Informationen findet man in folgenden Publikationen:</p>
<ul>
  <li>The (American) Lute Society Quarterly Vol 54 (2&amp;3), 10-12 (2019)</li>
  <li>De Tabulatuur no. 120, 20-25 (nov 2020)</li>
  <li>Il Liuto no. 20, 2-11 (2020)</li>
  <li>Lauteninfo 2020-02, 25-30 (2020)</li>
  <li>Geluit-Luthinerie no. 83 3/2021, 8-11 (hollandisch)</li>
  <li>Geluit-Luthinerie no. 83 3/2021, 17-20 (franzosisch)</li>
  <li>Bulletin der Societé Français de Luth (2020, ohne weitere Information).</li>
</ul>

<h4>Personen</h4>
<p><i>Peter Steur</i></p>
<p>Ich bin ein Niederländer, der seit 1986 in Italien lebt und arbeitet (Physiker, im Bereich der Metrologie, die sich um die Erhaltung der nationalen Maßeinheiten wie Meter und Kilogramm kümmert). Im Alter von 32-33 lernte ich das Barocklautespiel in den Niederlanden durch Unterricht bei Margriet Verzijl-Harperink. Dort kam ich auch in Kontakt mit einigen (professionellen) niederländischen Lautenspielern, die mich freundlicherweise mit ersten Kopien von Quellen versorgten. Die Sammlung erweiterte sich durch Ausdrucke von Mikrofilmen, die bei jemandem herumlagen. Danach wuchs meine Sammlung von Quellen langsam aber stetig an durch den Tausch mit anderen, in Europa und außerhalb. Während meiner ersten Jahre in Italien hatte ich die Gelegenheit einige zusätzliche Stunden bei Jakob Lindberg zu nehmen, was aber durch seinen Umzug nach London und später in seine Heimat Schweden aufhörte.
</p>
<p><i>Markus Lutz (gest. 2023)</i><p>
<p>Markus Lutz war bis zu seinem Tod 25 Jahre lang Pfarrer in Bad Buchau. Darüber hinaus war er in der Deutschen Lautengesellschaft (DLG) sehr aktiv und hat z.B. eine zeitlang an deren Mitgliederzeitschrift "Lauten-Info" mitgewirkt und dessen Tabulaturbeilage betreut. Auch sein Engagement beim Aufbau dieser Webseite war ein wertvoller Beitrag für die Pflege und Erschließung der Lautenmusik.
</p>
<p><i>Christoph Dalitz</i></p>
<p>Ich bin von Hause aus ebenfalls Physiker, aber schon eine Weile beruflich im Bereich Informatik tätig. Darüber hinaus veröffentliche ich Kompositionen (überwiegend Vokalwerke) auf meiner Webseite <a href="http://music.dalitio.de" target="_blank">music.dalitio.de</a>
  und habe das Noten- und Tabulatursatzprogramm <a href="https://www.lautengesellschaft.de/cdmm/" target="_blank">abctab2ps</a>
geschrieben, das von dieser Webseite zur Generierung der Inzipits genutzt wird. Weil ich diese Datenbank selbst schon viel genutzt habe, um mir das Repertoire der Barocklaute zu erschließen, war es mir wichtig, dass diese Websiete weiter existiert und so bin ich gerne der Bitte des Vorstands der DLG nachgekommen, mich darum zu kümmern.
</p>
<p>Eine Liste weiterer Personen, die auf verschiedene Weise zu diesem Projekt beigetragen haben, findet man in den <a href="index.php?id=2&type=acknow&lang=deu">Danksagungen</a>.
</p>
<?php
}
if ($lang=='eng') {
?>
<h3>About this project</h3>
<p>This database began with private indices of many sources and a loose series of concordances collected by Peter Steur. In 2007, Markus Lutz sent him his compilation of Weiss' works with concordances, with the request to check the concordances, which initiated a more systematic approach. Eventually, Markus Lutz suggested publishing all this information on a dedicated website <i>mss.slweiss.de</i>. Markus took care of design, programming and maintaining the website, and occasionally contributed content, whereas Peter continued to systematically add and correct the database content.
</p>
<p>After the death of Markus Lutz in 2023, the website was no longer maintained and at the risk of going offline. After it actually went offline due to an attack, Christoph Dalitz reconstructed it and made it available again on behalf of Markus' widow. In 2024, the German Lute Society (DLG) took over the contract and the operation of the website and Christoph Dalitz maintains its programming. Additionally, he has set up the github project <a href="https://github.com/cdalitz/lute-manuscripts" target="_blank">lute-manuscripts</a>, which makes code and content available under the GNU General Public License.
</p>

<h4>Concordances sources</h4>
<p>Concordances not already supplied by Markus were taken from</p>
<ul>
<li>the listings contained in the CLF editions for V.Gaultier, Mesangeau and Dufault,</li>
<li>annotations obtained from F.-P. Goy on mss obtained by exchange,</li>
<li>where applicable, the indications from François-Pierre Goy & Andreas Schlegel's website Accords nouveaux have been gratefully used, together with available new concordances. The Accords Nouveaux are indicated by the type of tuning as numbered by François-Pierre Goy, just behind the key (blue in brackets), and each piece has also a PAN number (pièces en accords nouveaux) below the key. For their meaning, the reader is referred to the website Accords nouveaux.</li>
<li>the web-based catalogue by Christian Meyer (Univ de Strassbourg), now discontinued,</li>
<li>lists of Tim Crawford, especially those of Mss Danby, Wn396, GoëssI, GoëssII and others,</li>
<li>my own discoveries, with additional ones surfacing just during working with the database.</li>
<li>occasional suggestions from third parties (most appreciated!)</li>
</ul>
<p>Currently, the database includes content from over 1000 sources, some possibly incomplete. As the database was initially meant for private use, it is possible that some sources are still named inconsistently: e.g., 'Reynaud' and 'F-Aix' had been used for the same manuscript for a long time. At first, the material was limited to the baroque lute, but when most of the available material was present in the database, various parties asked for a widening of the scope of the database - first to material for the renaissance lute and then also to the mandora and the cittern. A possible future extension can be chamber music including the lute. Constructive help for completing the content is always welcome!
</p>

<h4>Structure of the Database</h4>
<p>Since a detailed discussion of the structure of the database has already been published, only a short description is given here. Use is made of essentially three *.csv file types:
</p>
<ul>
  <li>a source-description file (<i>MssNames.csv</i>)</li>
  <li>a file dedicated to the concordances (<i>Concordances.csv</i>)</li>
  <li>one file per source, containing info on the various pieces they contain together with an incipit.</li>
</ul>
<p>The concordance numbers come essentially in two categories: those for the baroque lute - where the number is preceded by "_", and for the renaissance lute (or the renaissance period) - where the number is preceded by "R". This subdivision is not rigorous since many pieces occur in both periods. The many incipits, now almost 65000, are encoded in the text based format of the music typesetting program abctab2ps. The web interface even provides an option to search among the incipits, using the format of abctab2ps, allowing to possibly find new concordances.
</p>
<p>Further information can be found in the following publications:</p>
<ul>
  <li>The (American) Lute Society Quarterly Vol 54 (2&amp;3), 10-12 (2019)</li>
  <li>De Tabulatuur no. 120, 20-25 (nov 2020)</li>
  <li>Il Liuto no. 20, 2-11 (2020)</li>
  <li>Lauteninfo 2020-02, 25-30 (2020)</li>
  <li>Geluit-Luthinerie no. 83 3/2021, pp. 8-11 (dutch)</li>
  <li>Geluit-Luthinerie no. 83 3/2021, pp. 17-20 (french)</li>
  <li>Bulletin of the Societé Français de Luth (2020, no further info available, at present)</li>
</ul>

<h4>Authors</h4>
<p><i>Peter Steur</i></p>
<p>I am a Dutchman living and working since 1986 in Italy, as a physicist, in the field of Metrology (maintenance of the national units of measurements such as the Meter and the Kilogram) and since 2018 retired. I learned to play the baroque-lute on age 32-33 in The Netherlands, with private lessons from Margriet Verzijl-Harperink. While still there, I got to know several of the (professional) Dutch lute players, who kindly provided me with a copy of my first sources. These were then extended by prints from microfilms that somebody still had lying around. Then, my source library increased slowly but steadily by exchange with others, in Europe and outside. During the first years in Italy, I had the opportunity to take some occasional lessons with Jakob Lindberg, but these stopped on his transfer first to London and then to his home country Sweden.
</p>

<p><i>Markus Lutz (decd. 2023)</i></p>
<p>Until his death, Markus was a pastor in Bad Buchau for 25 years. Moreover, he was very active in the German Lute Society (DLG) and, among other things, edited parts of its journal "Lauten-Info". His involvement in setting up this website was a valuable contribution to the preservation and development of lute music.
</p>

<p><i>Christoph Dalitz</i></p>
<p>After studying physics, I eventually settled on working as a computer scientist. Moreover, I publish new (mostly vocal) compositions on my website <a href="http://music.dalitio.de" target="_blank">music.dalitio.de</a>, and I have written the music and tablature typesetting software <a href="https://www.lautengesellschaft.de/cdmm/" target="_blank">abctab2ps</a>, which is used by this website for generating the incipit images. As I have used this database myself a lot for exploring the baroque lute repertory, I considered it important to keep the project alive. Thus, I was happy to comply with the DLG Executive Board's request to take care of it.
</p>
<p>A list of further persons who have cotributed to this project in different ways can be found in the <a href="index.php?id=2&type=acknow&lang=eng">Acknowledgements</a>.
</p>
<?php
}
?>
