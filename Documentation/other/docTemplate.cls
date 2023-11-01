\RequirePackage{ifthen}
% This package allows you to create conditionals on booleans
\RequirePackage{ifdraft}
\newboolean{svn}

% Better handling of arguments, particularly for defaults
\RequirePackage{xargs}

%% ---------------- Declaration of Options--------------------
%% Remember that we have \AtEndOfClass{},\AtEndOfPackage{}
%%     \AtBeginDocument{}, \AtEndDocument{}
%% If you want execution conditional on file existence
%%     \IfFileExists{filename}{true}{false}
%%     \InputIfFileExists{filename}{true}{false}
%% For error reporting
%%     \ClassError{class-name}{error-text}{help-text}
%%     \PackageError{class-name}{error-text}{help-text}
%\DeclareOption{rulogotitle}{
% % TODO: finish this.  RU logo on the title page
% 
% }
%% otherwise, just a generic title page

\DeclareOption{svn}{
  \setboolean{svn}{true}
}

%% now we pass the remaining unused options to our parent class
\DeclareOption*{\PassOptionsToClass{\CurrentOption}{article}}
%% ---------------- Execution of Options -----------------------------
\ProcessOptions \relax % this stops searching for a * in
                       % \ProcessOtions*

%% Alternative way to subclass.  Disable the other option processing
%% if you enable it.  This will dump all options onto the parent class
%\ProcessOptions\LoadClassWithOptions{article}
%% ---------------- Package Loading -----------------------------
\LoadClass[12pt]{article}  % our parent class.  Article is a little easier
                     % to work with than the report class.
\RequirePackage[T1]{fontenc}
\RequirePackage[utf8]{inputenc}  % allows UTF encoding, needed for Icelandic characters
\RequirePackage[letterpaper, margin=2cm]{geometry}
% \addtolength{\oddsidemargin}{-.25in}
% 	\addtolength{\evensidemargin}{-.25in}
% 	\addtolength{\textwidth}{.5in}


\RequirePackage{fancyhdr}
%% Some slighly more sensible margins on an A4 page
%% This can be tuned for your given report

% Some useful fonts, particularly for listings
\RequirePackage{lipsum}
\RequirePackage{courier}

% Need this for the tables used in books
% \toprule, \midrule, \botrule
\RequirePackage{booktabs}


\ifthenelse{\boolean{svn}}{
        % switching to the svn-multi package which is much smarter
  %\RequirePackage[today,fancyhdr]{svninfo} 
  % grab the SVN revision information from a \svninfo $Id: ipfwpaper.cls 146 2016-08-22 16:02:15Z foley $
  %% today option sets the current day to the latest SVN date
  %% Remember that you will need to put a \svninfo and \svnKeyword
  %% into your document or it will only grab the revision information
  %% of the class file!  Also, you will need to set the svn:keywords properties.
  %\svnInfo $Id: ipfwpaper.cls 146 2016-08-22 16:02:15Z foley $
  %\svnKeyword $HeadURL: https://repository.cs.ru.is/svn/mechatronics/guides/ipfwpaper.cls $
  \RequirePackage{svn-multi}
}{ % If svninfo not installed, we load it invisibly to avoid problems
  %\RequirePackage[notoday,nofancy,final]{svninfo} 
    \RequirePackage{svn-multi}
}


%% Nice options for tweaking the header and footer

\PassOptionsToPackage{final}{graphicx}
\RequirePackage{graphicx}
%% We give the "final" option so that it always includes graphics
%% Take out this option if you want draft mode to skip pics

\DeclareGraphicsExtensions{.pdf,.jpeg,.jpg,.png,.gif,.PDF,.JPEG,.JPG,.PNG,.GIF}
%% The extensions that it will search for as valid graphics files
%% We need To include the UPPERCASE versions For windows people

\graphicspath{{graphics/}{Graphics/}{./}}
%% This is a list of folders to search for graphics files to include
%% Each path should be in a {}.  
%% Make sure that the upper/lowercase of the letters matches the folder or
%% you may have weird problems with partners using other operating systems.
%% Note that you don't have to put the folder where the .tex file is, it is
%% included automatically, though it is bad practice to put your 
%% graphics there

\PassOptionsToPackage{final}{pdfpages}
\RequirePackage{pdfpages}
%% The "pdfpages" package lets you include PDF documents into your
%% document but keeps the formatting consistent (headers, footers,
%% etc.)

%\RequirePackage{lastpage}
% The "lastpage" package allows you to set a command that knows
% what the last page was e.g. page 1 of 4

%% declare the paths(s) where you graphics files can be found
%% This allows you to skip putting the full path in
%% If you put a // at the end, it will recursively search for graphics
%% files, but be careful!
\RequirePackage{pseudocode}


%% The url package typesets url's and unix file paths nicely when they
%% become long.  Warning: windows paths such as C:\window do not work!
%% You need another verbatime to make those typeset properly.
\PassOptionsToPackage{obeyspaces,spaces,hyphens,allowmove}{url}
% first pass options to deal with spaces and hyphens properly
% allowmove: allow URLs in fragile commands but may break very badly
\RequirePackage{url}


%% The xspace package will try to figure out if you meant to have a
%% space after a new command if you don't give it any arguments (in
%% braces: {} ).  
\RequirePackage{xspace}

%% By default, set to 1.5 spacing
\linespread{1.3}  % this method does not require the setspace package

% % some font package possibilities
% % From http://www.macfreek.nl/memory/Fonts_in_LaTeX
%\RequirePackage{lmodern}
%\RequirePackage{times}
%\RequirePackage{palatino}
%\RequirePackage{bookman}
%\RequirePackage{newcent}
\RequirePackage{helvet}

% The old template uses san-serif, let's also do so 
\renewcommand{\familydefault}{\sfdefault}

%% ---------------- Main Code -----------------------------
%%  Remember that we can declar commands (to make fragile things safe)
%%  The * form is for ``short'' commands, not longer than a paragraph
%%       \DeclareRobustCommand{cmd}[num][default]{definition}
%%       \DeclareRobustCommand*{cmd}[num][default]{definition}
%%  For checking if commands are redefined
%%       \CheckCommand{cmd}[num][default]{definition}

% this is for the picture environment
\setlength{\unitlength}{1cm}

%% AMS is American Mathematics Society.  They have a bunch of nice
%% math fonts and symbols
\RequirePackage{amsfonts}
\RequirePackage{amsmath}
\RequirePackage{amssymb}

%% Advanced matrix formating
\RequirePackage{array}

%% Helpful math tools
\RequirePackage{mathtools}

%% Some symbols that don't exist in all fonts
\RequirePackage{textcomp}

%%Adjustment to figure label
\RequirePackage{caption}

%% Units formatting according to SI rules
\RequirePackage{siunitx} 

% another verbatim environment
\RequirePackage{examplep} 

\PassOptionsToPackage{final}{listings}
\RequirePackage{listings} % force final or included files are skipped, invisibly!
% This allows you to include code easily
% \begin{lstlisting}[language=bash]
%  $ wget http://blah
% \end{lstlisting}
% or for simpler snippets
%  \lstinline^cp -rp foo bar^
%  You can replace ^ with any character not in your code
\lstset{%
        language=, %default similar to verbatim
  basicstyle=\footnotesize\ttfamily,%
  frame=lines,%
  breaklines=true,%
  postbreak=\raisebox{0ex}[0ex][0ex]{\ensuremath{\color{red}\hookrightarrow\space}}, % red arrow
  % from http://tex.stackexchange.com/questions/116534/lstlisting-line-wrapping
}
% Here are listings macros I use a lot
\newcommand{\fpath}{\lstinline}  % magic, do not try to give it arguments
\newcommand{\shcmd}{\lstinline}  
% ex:  \fpath{\\AFS\.rnd.ru.is\course\T-411-MECH}


%% Nice package for making sub figures inside of a figure.  Keeps all
%% the reference labels correct and makes "sub captions"
% % WARNING: this is completely different than the subfigure package
\RequirePackage{subfig}



% FIXME system for making notes to each other for what needs to 
% be completed in a group document.
\RequirePackage[layout=inline]{fixme}

% internal layouts: inline, margin, footnote, index, marginclue
% % Warning! The pdf external layouts do not play well with hyperref
% % and must be loaded by doing \fxuselayouts{}
% external layouts: marginnote, pdfnote, pdfmargin, pdfsignote, pdfsigmargin
%     pdfcnote, pdfcmargin, pdfcsignote, pdfcsigmargin
%  pdfc stands for pdf color
%\fxuselayouts{pdfcmargin}

% Pass options for hyperlinks (which must be just before \begin{document}
%   final: always put hyperlinks
%   hidelinks: don't change color or text on hyperlink
\PassOptionsToPackage{final,hidelinks}{hyperref}



%% The "xcolor" package allows us to set the color of text and other
%% objects in a document
\RequirePackage{xcolor}
\definecolor{rugray}{rgb}{0.2,0.2,0.2}
\definecolor{rured}{rgb}{0.84,0.10,0.13}

%% The booktabs package makes book-quality tables by adjusting spacing
%% \toprule \midrule \bottomrule
%% \cmidrule[<wd>](<trim>){a–b}
%% \addlinespace[<wd>] % extra space between rows
\RequirePackage{booktabs}

%% ----- Setup page layout, including title page ----- %%

%% First we need to create some "variables" with defaults and commands
%% defaults
\newcommand{\title@docTemplate}{Report Template}
\newcommand{\shorttitle@docTemplate}{Template}
\newcommand{\author@docTemplate}{Juan E Florez-Coronel}
\newcommand{\po@docTemplate}{Owner}
\newcommand{\henrymentor@docTemplate}{Course Student:}
\newcommand{\course@docTemplate}{HENRY Data Science Part Time 3}
\newcommand{\revision@docTemplate}{Revision 1.0}

\newcommand{\formatemail}[1]{$<$\texttt{#1}$>$}

%% commands to set them
\newcommand{\shorttitle}[1]{\renewcommand{\shorttitle@docTemplate}{\ifdraft{\color{rured}DRAFT:}{} #1}}
\renewcommand{\title}[1]{\renewcommand{\title@docTemplate}{#1}\shorttitle{#1}}
% assume that the short title should be same as normal title unless specified
\renewcommand{\author}[1]{\renewcommand{\author@docTemplate}{#1}}

\newcommand{\po}[1]{\renewcommand{\po@docTemplate}{Product Owner: \\#1}}

\newcommand{\henrymentor}[1]{\renewcommand{\henrymentor@docTemplate}{Henry Mentor: \\#1}}

\newcommand{\course}[1]{\renewcommand{\course@docTemplate}{#1}}

\newcommand{\revision}[1]{\renewcommand{\revision@docTemplate}{Revision #1\\}}

\renewcommand{\maketitle}{
  {\centering%
    {\LARGE
      \vspace*{1cm}%
      \includegraphics[width=.6\textwidth]{henryLogo}
       \vspace*{3cm}
      \\\vspace{\baselineskip}
      \ifdraft{\fbox{\color{rured}DRAFT!  DO NOT SUBMIT!}\\}{}
      {\LARGE \title@docTemplate\\}
      \vspace{\baselineskip}
      \large\author@docTemplate\\
      \vfil
      \normalsize\po@docTemplate\\
      \vspace{\baselineskip}
      \normalsize\henrymentor@docTemplate\\
      \vspace{\baselineskip}
      \course@docTemplate\\      
      \revision@docTemplate
    }
    {\large
      \vfil
      \today\\
        \ifthenelse{\boolean{svn}}{SVN Revision \svnrev}{}  
      \vfil
    }
  }
  \clearpage
}

\pagestyle{fancyplain} % rest of the document should have fancy headers
                       % but not too fancy
\thispagestyle{empty} % title page should not have the headers and
                      % footers

\lhead{\shorttitle@docTemplate}
\rhead{\leftmark}
\setlength{\headheight}{15pt}% to make fancyhdr happy
%% on the rest of the pages, these will be the headers.  The first letter
%% indicates which side.  "r" for right, "c" for center, "l" for left 
%\lfooter{}
%\rfooter{}
%% set these for if you need to adjust the footers. 


%% This will load custom.tex with your custom macros and definitions if it exists
%% We load this last so that it can overrite any existing settings
\IfFileExists{custom.tex}{\input{custom.tex}}{}

%------Section Title Spacing------%
\usepackage{titlesec}
\titlespacing*{\section}{0pt}{\baselineskip}{\baselineskip}
\titlespacing*{\section}
{0pt}{\baselineskip}{-.0025\baselineskip}
%------Section Title Spacing------%

%------Page Setup------%
\linespread{1.1}
\parskip = 5pt 
%------Page Setup------%

%------Caption Setup for Figure and Table------%
\captionsetup[figure]{labelfont={bf},labelformat={default},labelsep=period,name={Figure }}
  
\DeclareCaptionFormat{myformat}{#1#2 #3}
\captionsetup[table]{format=myformat,labelfont=bf,labelsep=period,justification=justified}
%------Caption Setup for Figure and Table------%
  
%------Revision Table Commands---%
\newcommand{\startTable}{\begin{table}[H]
\centering
  %\captionsetup{singlelinecheck=off}	
  \caption{Document Revision History}
  \begin{tabular}{|p{2cm}|p{2cm}|p{10cm}|}
  	\hline
    \textbf{Revision} & \textbf{Date} & \textbf{Reason for Revision Change(s)} \\
    \hline}
    
\newcommand{\AddRevision}[3]{#1&#2  &#3\\\hline}

\newcommand{\stopTable}{
 \end{tabular}
 \label{tab:document_revisions}
\end{table}}
%----------------------------------%

\usepackage[utf8]{inputenc}
\usepackage{enumitem,amssymb}
\usepackage{colortbl}
\usepackage{float}
\usepackage{caption}
\usepackage{graphicx}
\usepackage{pdfpages}
\usepackage{gensymb}
\usepackage[automake]{glossaries}
\setacronymstyle{long-sc-short}
\usepackage{multicol}
\usepackage{multirow}
\usepackage{hyperref} % must be last package loaded!
% it makes hyper-references (citations, URLs, etc) clickable


%% declare the paths(s) where you graphics files can be found
\graphicspath{{graphics/}{Graphics/}{./}}

\renewcommand{\contentsname}{Table of Contents}



% %---------------Formating "\Paragraph"------------------%
% %This enable paragraphs to be numbered automatically. Use \paragraph{} 
% % to create the fourth level. e.g. 4.3.3.2
% \makeatletter
% \renewcommand\paragraph{\@startsection{paragraph}{4}{\z@}%
%             {-2.5ex\@plus -1ex \@minus -.25ex}%
%             {1.25ex \@plus .25ex}%
%             {\normalfont\normalsize\bfseries}}
% \makeatother
% \setcounter{secnumdepth}{4} % how many sectioning levels to assign numbers to
% \setcounter{tocdepth}{4}    % how many sectioning levels to show in ToC
% %-------------------------------------------------------%


