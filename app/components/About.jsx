import React from 'react';

const About = () => (
    <div className="about-plugin">
        <p>This plugin is developed for the Senior PHP Developer Test of AwesomeMotive Inc.</p>
        <p>This utilizes Composer and PSR-4 for autoload and namespaces.</p>
        <p>Front-end of this plugin has developed using React JS.</p>
        <p> Author : Dasun Edirisinghe ( <a href="mailto:dazunj4me@gmail.com">dazunj4me@gmail.com</a> )</p>
        <p>Additional Libraries</p>

            <ul>
                <li><a href="https://github.com/reactjs/react-tabs">React Tabs</a></li>
                <li><a href="http://gorangajic.github.io/react-icons/">React Icons</a></li>
                <li><a href="https://github.com/matthew-andrews/isomorphic-fetch">Isomorphic Fetch</a> </li>
            </ul>

    </div>
);

export default About;